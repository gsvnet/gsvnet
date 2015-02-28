<?php namespace Admin;

use GSV\Commands\Users\RegisterUserCommand;
use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\RegisterUserValidator;
use GSVnet\Users\User;
use GSVnet\Users\UserTransformer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use View, Input, Redirect, Event;

use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserValidator;
use GSVnet\Users\UserManager;
use GSVnet\Users\YearGroupRepository;
use GSVnet\Users\Profiles\UserProfile;
use GSVnet\Users\Profiles\AdminProfileCreatorValidator;
use GSVnet\Users\Profiles\AdminProfileUpdaterValidator;

class UsersController extends AdminBaseController {

    protected $users;
    protected $yearGroups;
    protected $validator;
    protected $profileCreatorValidator;
    protected $profileUpdaterValidator;
    protected $userManager;
    private $profiles;

    public function __construct(
        UserManager $userManager,
        UserValidator $validator,
        AdminProfileCreatorValidator $profileCreatorValidator,
        AdminProfileUpdaterValidator $profileUpdaterValidator,
        UsersRepository $users,
        ProfilesRepository $profiles,
        YearGroupRepository $yearGroups)
    {
        $this->userManager = $userManager;
        $this->validator = $validator;
        $this->profileCreatorValidator = $profileCreatorValidator;
        $this->profileUpdaterValidator = $profileUpdaterValidator;
        $this->users = $users;
        $this->yearGroups = $yearGroups;
        $this->profiles = $profiles;

        $this->beforeFilter('has:users.manage', ['except' => ['index', 'showGuests', 'showPotentials', 'showMembers', 'showFormerMembers']]);

        parent::__construct();
    }

    public function index()
    {
        $users = $this->users->paginateLatelyRegistered(50);

        return view('admin.users.index')->with('users', $users);
    }

    public function showGuests()
    {
        $users = $this->users->paginateLatestRegisteredGuests(50);

        return view('admin.users.visitors')->with('users', $users);
    }

    public function showPotentials()
    {
        $users = $this->users->paginateWhereType(User::POTENTIAL, 300);

        return view('admin.users.potentials')->with(['users' => $users]);
    }

    public function showMembers()
    {
        $search = Input::get('zoekwoord', '');
        $type = User::MEMBER;
        $regions = Config::get('gsvnet.regions');
        $perPage = 300;

        // Search on region
        if (!($region = Input::get('regio') and array_key_exists($region, $regions)))
            $region = null;

        // Enable search on yeargroup
        if (!($yearGroup = Input::get('jaarverband') and $this->yearGroups->exists($yearGroup)))
            $yearGroup = null;

        $profiles = $this->profiles->searchAndPaginate($search, $region, $yearGroup, $type, $perPage);
        $yearGroups = $this->yearGroups->all();

        return view('admin.users.leden')->with('profiles', $profiles)
            ->with('yearGroups', $yearGroups)
            ->with('regions', $regions);
    }

    public function showFormerMembers()
    {
        $search = Input::get('zoekwoord', '');
        $regions = Config::get('gsvnet.regions');
        $type = User::FORMERMEMBER;
        $perPage = 300;
        $reunistInput = Input::get('reunist');
        $reunist = null;

        // Search on region
        if (!($region = Input::get('regio') and array_key_exists($region, $regions)))
            $region = null;

        // Enable search on yeargroup
        if (!($yearGroup = Input::get('jaarverband') and $this->yearGroups->exists($yearGroup)))
            $yearGroup = null;

        // Search for reunists?
        if($reunistInput == 'ja')
            $reunist = true;
        if($reunistInput == 'nee')
            $reunist = false;

        $profiles = $this->profiles->searchAndPaginate($search, $region, $yearGroup, $type, $perPage, $reunist);
        $yearGroups = $this->yearGroups->all();

        return view('admin.users.oud-leden')->with('profiles', $profiles)
            ->with('yearGroups', $yearGroups)
            ->with('regions', $regions);
    }

    public function exportFormerMembers()
    {
        $users = $this->users->getAllByType(User::FORMERMEMBER);
        $transformer = new UserTransformer;
        return response()->csv($transformer->batchCsv($users), 'oud-leden.csv');
    }

    public function exportMembers()
    {
        $users = $this->users->getAllByType(User::MEMBER);
        $transformer = new UserTransformer;
        return response()->csv($transformer->batchCsv($users), 'leden.csv');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(RegisterUserValidator $validator)
    {
        $input = Input::only('type', 'username', 'firstname', 'middlename', 'lastname', 'email', 'password', 'password_confirmation');
        $input['approved'] = true;

        $validator->validate($input);

        // set random password if password is empty
        if(empty($input['password']))
            $input['password'] = str_random(16);

        // Map to command input
        $data = [
            'firstName' => $input['firstname'],
            'middleName' => $input['middlename'],
            'lastName' => $input['lastname'],
            'userName' => $input['username'],
            'type' => $input['type'],
            'email' => $input['email'],
            'password' => $input['password'],
            'approved' => true
        ];

        $this->dispatchFrom(RegisterUserCommand::class, new Collection($data));

        $message = '<strong>Gebruiker</strong> is succesvol opgeslagen.';
        return redirect()->action('Admin\UsersController@showGuests')
            ->withMessage($message);
    }

    public function show($id)
    {
        $user = $this->users->byId($id);
        $profile = $user->profile;
        $committees = $user->committees;

        return view('admin.users.show')
            ->withUser($user)
            ->withProfile($profile)
            ->withCommittees($committees);
    }

    public function edit($id)
    {
        $user = $this->users->byId($id);
        $yearGroups = $this->yearGroups->all();
        $profile = $user->profile;

        return view('admin.users.edit')
            ->with([
                'user' => $user,
                'profile' => $profile,
                'yearGroups' => $yearGroups
            ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \GSVnet\Core\Exceptions\ValidationException
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    public function update($id)
    {
        $oldUser = $this->users->byId($id);

        $userData = Input::only('type', 'username', 'firstname', 'middlename', 'lastname', 'email');
        
        // Check if password is to be set
        $password = Input::get('password', '');

        if(!empty($password))
        {
            $userData['password'] = $password;
            $userData['password_confirmation'] = Input::get('password_confirmation', '');
        }

        $this->validator->validate($userData);

        $user = $this->users->update($id, $userData);

        Event::fire('user.updated', [
            'old' => $oldUser,
            'new' => $user
        ]);

        $message = '<strong>' . $user->present()->fullName . '</strong> is succesvol bewerkt.';
        return redirect()->action('Admin\UsersController@show', $id)->withMessage($message);
    }

    public function destroy($id)
    {
        $user = $this->users->delete($id);

        return redirect()->action('Admin\UsersController@index')
            ->with('message', '<strong>' . $user->name . '</strong> is succesvol verwijderd.');
    }

    public function storeProfile($id)
    {
        $input = [];
        $input['user_id'] = $id;

        // volgende moet eigenlijk naar een repo
        $this->profileCreatorValidator->validate($input);
        $user = $this->users->byId($id);
        $profile = UserProfile::create($input);

        $message = '<strong>' . $user->present()->fullName . '</strong> heeft een GSV-profiel.';
        return redirect()->action('Admin\UsersController@edit', $user->id)->withMessage($message);
    }

    public function destroyProfile($id)
    {
        $user = $this->users->byId($id);
        $user->profile()->delete();

        return redirect()->action('Admin\UsersController@edit', $user->id)
            ->with('message', 'Profiel van <strong>' . $user->present()->fullName . '</strong> is succesvol verwijderd.');
    }

    public function updateProfile($id)
    {
        $input = Input::only('region', 'year_group_id', 'initials', 'phone', 'address', 'zip_code', 'town', 'study', 'student_number', 'birthdate', 'church', 'gender', 'parent_phone', 'parent_address', 'parent_zip_code', 'parent_town');
        $input['user_id'] = $id;
        $input['reunist'] = Input::get('reunist', false) == '1';

        if(! array_key_exists($input['region'], Config::get('gsvnet.regions')))
            $input['region'] = null;

        $this->profileUpdaterValidator->validate($input);

        $user = $this->users->byId($id);
        $user->profile()->update($input);

        $message = 'Profiel van <strong>' . $user->present()->fullName . '</strong> is succesvol bijgewerkt.';
        return redirect()->action('Admin\UsersController@show', $id)
            ->withMessage($message);
    }

    public function activate($id)
    {
        $user = $this->userManager->activateUser($id);

        return redirect()->action('Admin\UsersController@index')
            ->with('message', 'Account van <strong>' . $user->present()->fullName . '</strong> is succesvol geactiveerd.');
    }

    public function accept($id)
    {
        $user = $this->userManager->acceptMembership($id);

        return redirect()->action('Admin\UsersController@index')
            ->with('message', 'Noviet <strong>' . $user->present()->fullName . '</strong> is succesvol geïnstalleerd.');
    }


}