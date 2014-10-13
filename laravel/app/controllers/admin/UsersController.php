<?php namespace Admin;

use GSVnet\Newsletters\NewsletterList;
use GSVnet\Users\User;
use GSVnet\Users\UserTransformer;
use Illuminate\Http\Response;
use View, Input, Redirect, Event;

use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserValidator;
use GSVnet\Users\UserManager;
use GSVnet\Users\YearGroupRepository;
use GSVnet\Users\Profiles\UserProfile;
use GSVnet\Users\Profiles\AdminProfileCreatorValidator;
use GSVnet\Users\Profiles\AdminProfileUpdaterValidator;

class UsersController extends BaseController {

    protected $users;
    protected $yearGroups;
    protected $validator;
    protected $profileCreatorValidator;
    protected $profileUpdaterValidator;
    protected $userManager;

    public function __construct(
        UserManager $userManager,
        UserValidator $validator,
        AdminProfileCreatorValidator $profileCreatorValidator,
        AdminProfileUpdaterValidator $profileUpdaterValidator,
        UsersRepository $users,
        YearGroupRepository $yearGroups)
    {
        $this->userManager = $userManager;
        $this->validator = $validator;
        $this->profileCreatorValidator = $profileCreatorValidator;
        $this->profileUpdaterValidator = $profileUpdaterValidator;
        $this->users = $users;
        $this->yearGroups = $yearGroups;

        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'delete']]);
        $this->beforeFilter('has:users.manage', ['except' => ['index', 'showGuests', 'showPotentials', 'showMembers', 'showFormerMembers']]);

        parent::__construct();
    }

    public function index()
    {
        $users = $this->users->paginateLatelyRegistered(20);

        $this->layout->content = View::make('admin.users.index')
            ->withUsers($users);
    }

    public function showGuests()
    {
        $users = $this->users->paginateWhereType(0, 300);

        $this->layout->content = View::make('admin.users.index')
            ->with(['users' => $users]);
    }

    public function showPotentials()
    {
        $users = $this->users->paginateWhereType(1, 300);

        $this->layout->content = View::make('admin.users.index')
            ->with(['users' => $users]);
    }

    public function showMembers()
    {
        if(Input::get('output') == 'csv')
        {
            $users = $this->users->getAllByType(User::MEMBER);
            $transformer = new UserTransformer;
            return \Response::csv($transformer->batchCsv($users), 'leden.csv');
        }

        $users = $this->users->paginateWhereType(User::MEMBER, 300);

        $this->layout->content = View::make('admin.users.index')->with(['users' => $users]);
    }

    public function showFormerMembers()
    {
        if(Input::get('output') == 'csv')
        {
            $users = $this->users->getAllByType(User::FORMERMEMBER);
            $transformer = new UserTransformer;
            return \Response::csv($transformer->batchCsv($users), 'oud-leden.csv');
        }

        $users = $this->users->paginateWhereType(3, 300);

        $this->layout->content = View::make('admin.users.index')->with(['users' => $users]);
    }

    public function create()
    {
        $this->layout->content = View::make('admin.users.create');
    }

    public function store()
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        $this->validator->validate($input);
        $user = $this->users->create($input);

        $message = '<strong>' . $user->name . '</strong> is succesvol opgeslagen.';
        return Redirect::action('Admin\UsersController@index')
            ->withMessage($message);
    }

    public function show($id)
    {
        $user = $this->users->byId($id);
        $profile = $user->profile;
        $committees = $user->committees;

        $this->layout->content = View::make('admin.users.show')
            ->withUser($user)
            ->withProfile($profile)
            ->withCommittees($committees);
    }

    public function edit($id)
    {
        $user = $this->users->byId($id);
        $yearGroups = $this->yearGroups->all();
        $profile = $user->profile;

        $this->layout->content = View::make('admin.users.edit')
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
        return Redirect::action('Admin\UsersController@show', $id)->withMessage($message);
    }

    public function destroy($id)
    {
        $user = $this->users->delete($id);

        return Redirect::action('Admin\UsersController@index')
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
        return Redirect::action('Admin\UsersController@edit', $user->id)->withMessage($message);
    }

    public function destroyProfile($id)
    {
        $user = $this->users->byId($id);
        $user->profile()->delete();

        return Redirect::action('Admin\UsersController@edit', $user->id)
            ->with('message', 'Profiel van <strong>' . $user->present()->fullName . '</strong> is succesvol verwijderd.');
    }

    public function updateProfile($id)
    {
        $input = Input::only('region', 'year_group_id', 'phone', 'address', 'zip_code', 'town', 'study', 'student_number', 'birthdate', 'church', 'gender', 'parent_phone', 'parent_address', 'parent_zip_code', 'parent_town');
        $input['user_id'] = $id;
        $input['reunist'] = Input::get('reunist', false) == '1';
        $this->profileUpdaterValidator->validate($input);

        $user = $this->users->byId($id);
        $user->profile()->update($input);

        $message = 'Profiel van <strong>' . $user->present()->fullName . '</strong> is succesvol bijgewerkt.';
        return Redirect::action('Admin\UsersController@show', $id)
            ->withMessage($message);


    }

    public function activate($id)
    {
        $user = $this->userManager->activateUser($id);

        return Redirect::action('Admin\UsersController@index')
            ->with('message', 'Account van <strong>' . $user->present()->fullName . '</strong> is succesvol geactiveerd.');
    }

    public function accept($id)
    {
        $user = $this->userManager->acceptMembership($id);

        return Redirect::action('Admin\UsersController@index')
            ->with('message', 'Noviet <strong>' . $user->present()->fullName . '</strong> is succesvol geïnstalleerd.');
    }


}