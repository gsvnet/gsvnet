<?php

use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\YearGroupRepository;

class UserController extends BaseController {

    protected $users;
    protected $profiles;
    protected $yearGroups;

    public function __construct(
        ProfilesRepository $profiles,
        UsersRepository $users,
        YearGroupRepository $yearGroups)
    {
        parent::__construct();
        $this->profiles = $profiles;
        $this->users = $users;
        $this->yearGroups = $yearGroups;
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
}