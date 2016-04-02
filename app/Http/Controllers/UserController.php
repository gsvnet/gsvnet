<?php

use GSV\Commands\Users\ChangeEmail;
use GSV\Commands\Users\ChangePassword;
use GSVnet\Users\EmailAndPasswordValidator ;
use Illuminate\Http\Request;
use GSVnet\Committees\CommitteesRepository;
use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserManager;
use GSVnet\Users\Profiles\ProfileManager;
use GSVnet\Users\YearGroupRepository;

class UserController extends BaseController
{

    protected $users;
    protected $profiles;
    protected $committees;
    protected $yearGroups;
    protected $profileManager;
    protected $userManager;

    public function __construct(
        ProfilesRepository $profiles,
        UsersRepository $users,
        CommitteesRepository $committees,
        UserManager $userManager,
        ProfileManager $profileManager,
        YearGroupRepository $yearGroups)
    {
        parent::__construct();
        $this->profiles = $profiles;
        $this->users = $users;
        $this->committees = $committees;
        $this->yearGroups = $yearGroups;
        $this->userManager = $userManager;
        $this->profileManager = $profileManager;
        $this->committees = $committees;
    }

    /**
     * Show the current user's profile
     * @param Request $request
     * @return
     */
    public function showProfile(Request $request)
    {
        $member = $this->users->byIdWithProfileAndYearGroup($request->user()->id);
        $committees = $this->committees->byUserOrderByRecent($member);
        $senates = $member->senates;

        return view('users.profile')
            ->with('member', $member)
            ->with('committees', $committees)
            ->with('senates', $senates);
    }

    /**
     * Show current members
     * @param Request $request
     * @return
     */
    public function showUsers(Request $request)
    {
        $this->authorize('users.show');
        $search = $request->get('naam', '');
        $regions = Config::get('gsvnet.regions');
        $oudLeden = $request->get('oudleden');

        if (!($region = $request->get('regio') and array_key_exists($region, $regions))) {
            $region = null;
        }

        // Enable search on yeargroup
        if (!($yeargroup = $request->get('jaarverband') and $this->yearGroups->exists($yeargroup))) {
            $yeargroup = null;
        }

        $perPage = 50;
        $type = $oudLeden == '1' ? [User::MEMBER, User::FORMERMEMBER] : User::MEMBER;
        $members = $this->profiles->searchAndPaginate($search, $region, $yeargroup, $type, $perPage);

        // Select year groups
        $yearGroups = $this->yearGroups->all();

        // Create the view
        return view('users.index')
            ->with('members', $members)
            ->with('regions', $regions)
            ->with('yearGroups', $yearGroups);
    }

    /**
     * Show the user's profile
     */
    public function showUser($id)
    {
        $this->authorize('users.show');
        $member = $this->users->byIdWithProfileAndYearGroup($id);
        $committees = $this->committees->byUserOrderByRecent($member);
        $senates = $member->senates;

        return view('users.profile')
            ->with('member', $member)
            ->with('committees', $committees)
            ->with('senates', $senates);
    }

    public function editProfile(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        return view('users.edit-profile')->with([
            'user' => $user,
            'profile' => $profile
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;
        $input = $request->except('profile_photo_path');

        // Profile specific input
        $profileInput = [
            'church' => $input['profile_church'],
            'study' => $input['profile_study'],
            'initials' => $input['profile_initials'],
            'student_number' => $input['profile_student_number'],
            'address' => $input['profile_address'],
            'zip_code' => $input['profile_zip_code'],
            'town' => $input['profile_town'],
            'phone' => $input['profile_phone'],
            'gender' => $input['profile_gender'],
            'birthdate' => $input['profile_birthdate'],
            'parent_address' => $input['profile_parent_address'],
            'parent_zip_code' => $input['profile_parent_zip_code'],
            'parent_town' => $input['profile_parent_town'],
            'parent_phone' => $input['profile_parent_phone']
        ];

        if ($request->hasFile('profile_photo_path')) {
            $profileInput['photo_path'] = $request->file('profile_photo_path');
        }

        // Check if parent address is the same as potential address
        if ($request->get('parent_same_address', '0') == '1') {
            $profileInput['parent_address'] = $input['profile_address'];
            $profileInput['parent_town'] = $input['profile_town'];
            $profileInput['parent_zip_code'] = $input['profile_zip_code'];
        }

        // User specific input
        $userInput = [
            'email' => $input['email']
        ];

        // Create the profile and attach it to the user
        $newUser = $this->userManager->update($user->id, $userInput);

        $eventData = [
            'oldUser' => $user,
            'newUser' => $newUser,
            'oldProfile' => false,
            'newProfile' => false
        ];

        if (isset($profile) && Gate::allows('users.edit-profile')) {
            $newProfile = $this->profileManager->update($profile->id, $profileInput);
            $eventData['oldProfile'] = $profile;
            $eventData['newProfile'] = $newProfile;
        }

        event('user.updated', [
            'old' => $user,
            'new' => $newUser
        ]);

        event('profile.updatedByOwner', $eventData);

        // Redirect to the become-member page: it shows the 3rd step [done] as active page
        return redirect()->action('UserController@showProfile');
    }

    public function showAddresses()
    {
        $this->authorize('users.show');
        return view('trivia/locations');
    }
}