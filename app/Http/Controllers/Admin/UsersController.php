<?php namespace Admin;

use GSV\Commands\Users\RegisterUserCommand;
use GSVnet\Users\Profiles\AdminProfileCreatorValidator;
use GSVnet\Users\Profiles\AdminProfileUpdaterValidator;
use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\Profiles\UserProfile;
use GSVnet\Users\RegisterUserValidator;
use GSVnet\Users\User;
use GSVnet\Users\UserManager;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserValidator;
use GSVnet\Users\YearGroupRepository;
use Illuminate\Http\Request;
use GSVnet\Users\MemberFiler;
use GSVnet\Regions\RegionsRepository;

class UsersController extends AdminBaseController
{

    protected $users;
    protected $yearGroups;
    protected $regions;
    protected $validator;
    protected $profileCreatorValidator;
    protected $profileUpdaterValidator;
    protected $userManager;
    protected $filer;
    private $profiles;

    public function __construct(
        UserManager $userManager,
        UserValidator $validator,
        AdminProfileCreatorValidator $profileCreatorValidator,
        AdminProfileUpdaterValidator $profileUpdaterValidator,
        UsersRepository $users,
        ProfilesRepository $profiles,
        YearGroupRepository $yearGroups,
        RegionsRepository $regions,
        MemberFiler $filer
    ) {
        $this->userManager = $userManager;
        $this->validator = $validator;
        $this->profileCreatorValidator = $profileCreatorValidator;
        $this->profileUpdaterValidator = $profileUpdaterValidator;
        $this->users = $users;
        $this->yearGroups = $yearGroups;
        $this->profiles = $profiles;
        $this->regions = $regions;
        $this->filer = $filer;

        parent::__construct();
    }

    public function index()
    {
        $this->authorize('users.show');
        $users = $this->users->paginateLatelyRegistered(50);

        return view('admin.users.index')->with('users', $users);
    }

    public function showGuests()
    {
        $this->authorize('users.show');
        $users = $this->users->paginateLatestRegisteredGuests(50);

        return view('admin.users.visitors')->with('users', $users);
    }

    public function showPotentials()
    {
        $this->authorize('users.show');
        $users = $this->users->paginateLatestPotentials(50);

        return view('admin.users.potentials')->with(['users' => $users]);
    }

    public function showMembers(Request $request)
    {
        $this->authorize('users.show');
        $search = $request->get('zoekwoord', '');
        $type = User::MEMBER;
        $regions = $this->regions->all();
        $perPage = 300;

        // Search on region
        if (!($region = $request->get('regio') and $this->regions->exists($region)))
            $region = null;

        // Enable search on yeargroup
        if (!($yearGroup = $request->get('jaarverband') and $this->yearGroups->exists($yearGroup)))
            $yearGroup = null;

        $profiles = $this->profiles->searchAndPaginate($search, $region, $yearGroup, $type, $perPage);
        $yearGroups = $this->yearGroups->all();

        return view('admin.users.leden')->with('profiles', $profiles)
            ->with('yearGroups', $yearGroups)
            ->with('regions', $regions);
    }

    public function showFormerMembers(Request $request)
    {
        $this->authorize('users.show');
        $search = $request->get('zoekwoord', '');
        $regions = $this->regions->all();
        $type = User::FORMERMEMBER;
        $perPage = 300;
        $reunistInput = $request->get('reunist');

        // Search on region
        if (!($region = $request->get('regio') and $this->regions->exists($region)))
            $region = null;

        // Enable search on yeargroup
        if (!($yearGroup = $request->get('jaarverband') and $this->yearGroups->exists($yearGroup)))
            $yearGroup = null;

        // Search for reunists?
        $reunist = $reunistInput == 'ja' ? true : ($reunistInput == 'nee' ? false : null);

        $profiles = $this->profiles->searchAndPaginate($search, $region, $yearGroup, $type, $perPage, $reunist);
        $yearGroups = $this->yearGroups->all();

        return view('admin.users.oud-leden')->with('profiles', $profiles)
            ->with('yearGroups', $yearGroups)
            ->with('regions', $regions);
    }

    public function exportMembers()
    {
        $this->authorize('users.show');
        $this->filer->fileMembers()->export('xls');
    }

    public function create()
    {
        $this->authorize('users.manage');
        return view('admin.users.create');
    }

    public function store(Request $request, RegisterUserValidator $validator)
    {
        $this->authorize('users.manage');

        $input = $request->only('type', 'username', 'firstname', 'middlename', 'lastname', 'email', 'password', 'password_confirmation');
        $input['approved'] = true;

        $validator->validate($input);

        // set random password if password is empty
        if (empty($input['password']))
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

        $this->dispatchFromArray(RegisterUserCommand::class, $data);

        flash()->success('Gebruiker is succesvol opgeslagen.');

        return redirect()->action('Admin\UsersController@showGuests');
    }

    public function show($id)
    {
        $this->authorize('users.show');
        $user = $this->users->byId($id);

        // Committees or ordinary forum users do not need a fancy profile page
        if (!$user->wasOrIsMember() && !$user->isPotential())
            return view('admin.users.show')->with(compact('user'));

        // Since GDPR, not all (former) members still have profiles
        if (!$user->profile)
            return view('admin.users.show')->with(compact('user'));

        $profile = $user->profile;

        if ($user->wasOrIsMember()) {
            // Members, former members
            $committees = $user->committeesSorted;

            if (! $user->profile->alive) {
                return view('admin.users.showDeceasedMember')->with(compact('user', 'profile', 'committees'));
            }

            return view('admin.users.showMember')->with(compact('user', 'profile', 'committees'));
        }

        // Potentials
        return view('admin.users.showPotential')->with(compact('user', 'profile'));
    }

    public function destroy($id)
    {
        $this->authorize('users.manage');
        $user = $this->users->byId($id);

        if($profile = $user->profile) {
            $profile->delete();
        }
        $user->delete();

        flash()->success("Account is succesvol verwijderd.");

        return redirect()->action('Admin\UsersController@index');
    }

    public function storeProfile($id)
    {
        $this->authorize('users.manage');
        $input = [];
        $input['user_id'] = $id;

        // volgende moet eigenlijk naar een repo
        $this->profileCreatorValidator->validate($input);
        $user = $this->users->byId($id);
        UserProfile::create($input);

        flash()->success("{$user->present()->fullName} heeft een GSV-profiel.");

        return redirect()->action('Admin\UsersController@edit', $user->id);
    }

    public function destroyProfile($id)
    {
        $this->authorize('users.manage');
        $user = $this->users->byId($id);
        $user->profile()->delete();

        flash()->success("Profiel van {$user->present()->fullName} is succesvol verwijderd.");

        return redirect()->action('Admin\UsersController@edit', $user->id);
    }

    public function updateProfile(Request $request, $id)
    {
        $this->authorize('users.manage');
        $user = $this->users->byId($id);

        $input = $request->only('region', 'year_group_id', 'inauguration_date', 'initials', 'phone', 'address',
            'zip_code', 'town', 'study', 'student_number', 'birthdate', 'gender');
        $input['user_id'] = $id;

        // Set some specific info for former members
        if ($user->isFormerMember()) {
            $input['reunist'] = $request->get('reunist', '0') === '1';
            $input['resignation_date'] = $request->get('resignation_date');
            $input['company'] = $request->get('company');
            $input['profession'] = $request->get('profession');
        }

        // Natural parents
        if ($user->isMember()) {
            $input = array_merge($input, $request->only('parent_phone', 'parent_email', 'parent_address', 'parent_zip_code', 'parent_town'));
        }

        // Check if the region is valid
        if (!$this->regions->exists($input['region'])) {
            $input['region'] = null;
        }

        // Validate
        $this->profileUpdaterValidator->validate($input);

        // Update
        $user->profile()->update($input);

        flash()->success("Profiel van {$user->present()->fullName} is succesvol bijgewerkt.");

        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function activate($id)
    {
        $this->authorize('users.manage');
        $user = $this->userManager->activateUser($id);

        flash()->success("Account van {$user->present()->fullName} is succesvol geactiveerd.");

        return redirect()->action('Admin\UsersController@index');
    }

    public function accept($id)
    {
        $this->authorize('users.manage');
        $user = $this->userManager->acceptMembership($id);

        flash()->success("Noviet {$user->present()->fullName} is succesvol geïnstalleerd.");

        return redirect()->action('Admin\UsersController@index');
    }
}