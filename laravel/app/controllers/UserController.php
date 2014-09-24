<?php

use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserManager;
use GSVnet\Users\Profiles\ProfileManager;
use GSVnet\Users\YearGroupRepository;
use GSVnet\Permissions\Permission;

class UserController extends BaseController {

    protected $users;
    protected $profiles;
    protected $yearGroups;
    protected $profileManager;
    protected $userManager;

    public function __construct(
        ProfilesRepository $profiles,
        UsersRepository $users,
        UserManager $userManager,
        ProfileManager $profileManager,
        YearGroupRepository $yearGroups)
    {
        parent::__construct();
        $this->profiles = $profiles;
        $this->users = $users;
        $this->yearGroups = $yearGroups;
        $this->userManager = $userManager;
        $this->profileManager = $profileManager;
    }

    /**
     * Show the current user's profile
     */
    public function showProfile()
    {
        $member = $this->users->byIdWithProfileAndYearGroup(Auth::user()->id);
        $committees = $member->committees;
        $senates = $member->senates;

        $this->layout->bodyID = 'own-profile-page';
        $this->layout->activeMenuItem = 'intern';
        $this->layout->activeSubMenuItem = 'profiel';
        $this->layout->content = View::make('users.profile')
            ->with('member', $member)
            ->with('committees', $committees)
            ->with('senates', $senates);
    }


    /**
     * Show current members
     */
    public function showUsers()
    {
        $search = Input::get('name', '');

        $regions = Config::get('gsvnet.regions');

        if (! ($region = Input::get('region') and array_key_exists($region, $regions)))
        {
            $region = null;
        }

        // Enable search on yeargroup
        if (! ($yeargroup = Input::get('yeargroup') and $this->yearGroups->exists($yeargroup)))
        {
            $yeargroup = null;
        }

        $perPage = 200;
        $members = $this->profiles->searchAndPaginate($search, $region, $yeargroup, $perPage);

        // Select year groups
        $yearGroups = $this->yearGroups->all();

        // Create the view
        $this->layout->bodyID = 'user-list-page';
        $this->layout->activeMenuItem = 'intern';
        $this->layout->activeSubMenuItem = 'jaarbundel';
        $this->layout->content = View::make('users.index')
            ->with('members', $members)
            ->with('regions', $regions)
            ->with('yearGroups', $yearGroups);
    }

    /**
     * Show the user's profile
     */
    public function showUser($id)
    {
        $member = $this->users->byIdWithProfileAndYearGroup($id);
        $committees = $member->committees;
        $senates = $member->senates;

        $this->layout->bodyID = 'own-profile-page';
        $this->layout->activeMenuItem = 'intern';
        $this->layout->activeSubMenuItem = 'jaarbundel';
        $this->layout->content = View::make('users.profile')
            ->with('member', $member)
            ->with('committees', $committees)
            ->with('senates', $senates);
    }

    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->profile;

        $this->layout->bodyID = 'edit-profile-page';
        $this->layout->activeMenuItem = 'intern';
        $this->layout->activeSubMenuItem = 'jaarbundel';
        $this->layout->content = View::make('users.edit-profile')->with([
            'user' => $user,
            'profile' => $profile
        ]);
    }

    public function updateProfile()
    {
        $user = Auth::user();
        $profile = $user->profile;
        $input = Input::except(['profile_photo_path']);

        // Profile specific input
        $profileInput = [
            'church' => $input['profile_church'],
            'study' => $input['profile_study'],
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

        if (Input::hasFile('profile_photo_path'))
        {
            $profileInput['photo_path'] = Input::file('profile_photo_path');
        }

        // Check if parent address is the same as potential address
        if (Input::get('parent_same_address', '0') == '1')
        {
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

        if(isset($profile) && Permission::has('users.edit-profile'))
        {
            $newProfile = $this->profileManager->update($profile->id, $profileInput);
            $eventData['oldProfile'] = $profile;
            $eventData['newProfile'] = $newProfile;
        }

        Event::fire('user.updated', [
            'old' => $user,
            'new' => $newUser
        ]);

        Event::fire('profile.updatedByOwner', $eventData);

        // Redirct to the become-member page: it shows the 3rd step [done] as active page
        return Redirect::action('UserController@showProfile');
    }
}