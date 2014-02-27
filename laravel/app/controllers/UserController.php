<?php

use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserManager;
use GSVnet\Users\Profiles\profileManager;
use GSVnet\Users\YearGroupRepository;

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
        profileManager $profileManager,
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
        $member = Auth::user();

        $this->layout->bodyID = 'own-profile-page';
        $this->layout->content = View::make('users.profile')
            ->with('member', $member);
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

        $perPage = 10;
        $members = $this->profiles->searchAndPaginate($search, $region, $yeargroup, $perPage);

        // Select year groups
        $yearGroups = $this->yearGroups->all();

        // Create the view
        $this->layout->bodyID = 'user-list-page';
        $this->layout->content = View::make('users.index')
            ->with('members', $members)
            ->with('regions', $regions)
            ->with('yearGroups', $yearGroups);
    }

    public function showUser($id)
    {
        $member = GSVnet\Users\User::with('profile.yearGroup', 'committeesSorted')->find($id);

        //dd($member);

        $this->layout->bodyID = 'user-profile-page';
        $this->layout->content = View::make('users.profile')
            ->with('member', $member);
    }

    public function editProfile()
    {
        $this->layout->bodyID = 'edit-profile-page';
        $this->layout->content = View::make('users.edit-profile');
    }

    public function updateProfile()
    {
        $user = Auth::user();
        $input = Input::except(['potential-image']);

        if (Input::hasFile('potential-image'))
        {
            $input['photo'] = Input::file('potential-image');
        }

        // Check if parent address is the same as potential address
        if (Input::get('parents-same-address', '0') == '1')
        {
            $input['parents-address'] = $input['potential-address'];
            $input['parents-town'] = $input['potential-town'];
            $input['parents-zip-code'] = $input['potential-zip-code'];
        }

        // Create the profile and attach it to the user
        $profile = $this->userManager->update($user, $input);
        // $profile = $this->profileManager->update($user, $input);

        // Redirct to the become-member page: it shows the 3rd step [done] as active page
        return Redirect::action('UserController@showProfile');
    }
}