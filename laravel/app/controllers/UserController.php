<?php

class UserController extends BaseController {
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
        $member = Config::get('gsvnet.userTypes.member');
        $regions = Config::get('gsvnet.regions');

        // Initialize basic query
        $memberlistQuery = GSVnet\Users\Profiles\UserProfile::join('users', function($join) use ($member) {
            $join->on('users.id', '=', 'user_profiles.user_id')->where('users.type', '=', $member);
        })->orderBy('users.lastname');

        // Enable search on full name
        if(Input::has('name'))
        {
            $name = Input::get('name');
            $memberlistQuery->whereRaw(
                'users.firstname || " " || users.middlename ||  " " || users.lastname LIKE ?',
                array('%' . $name . '%')
            );
        }

        // Enable search on region
        if(Input::has('region'))
        {
            $region = intval(Input::get('region'));
            if(array_key_exists($region, Config::get('gsvnet.regions')))
            {
                $memberlistQuery->where('region', '=', $region);
            }
        }

        // Enable search on yeargroup
        if(Input::has('yeargroup') && GSVnet\Users\YearGroup::find(Input::get('yeargroup')))
        {
            $yeargroup = Input::get('yeargroup');
            $memberlistQuery->where('year_group_id', '=', $yeargroup);
        }

        // Retrieve results
        $memberlist = $memberlistQuery->paginate(200);

        // Select year groups
        $yearGroups = GSVnet\Users\YearGroup::orderBy('year', 'DESC')->get();

        // Create the view
        $this->layout->bodyID = 'user-list-page';
        $this->layout->content = View::make('users.index')
            ->with('members', $memberlist)
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
}