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
        $memberlistQuery = GSVnet\Users\UserProfile::join('users', function($join) use ($member) {
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

    public function postWordLid()
    {
        $user = Auth::user();
        $input = Input::all();

        // Construct a date from seperate day, month and year fields.
        $input['potential-birthdate'] = $input['potential-birth-year'] . '-' . $input['potential-birth-month'] . '-' . $input['potential-birth-day'];


        $rules = [
            'potential-image' => 'image',
            'potential-address' => 'required',
            'potential-zip-code' => 'required',
            'potential-town' => 'required',
            'potential-phone' => 'required',
            'potential-gender' => 'required|in:male,female',
            'potential-birthdate' => 'required|date_format:Y-m-d',
            'potential-church' => 'required',
            'potential-study-year' => 'required|date_format:Y',
            'potential-study' => 'required',
            'parents-address' => 'required',
            'parents-zip-code' => 'required',
            'parents-town' => 'required',
            'parents-phone' => 'required'
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $profile = GSVnet\Users\UserProfile::firstOrNew(array('user_id' => $user->id));
            $profile->user_id = $user->id;
            $profile->reunist = 0;
            $profile->region = 0;

            $profile->phone = $input['potential-phone'];
            $profile->address = $input['potential-address'];
            $profile->zip_code = $input['potential-zip-code'];
            $profile->town = $input['potential-town'];
            $profile->study = $input['potential-study'];
            $profile->birthdate = $input['potential-birthdate'];
            $profile->church = $input['potential-church'];
            $profile->gender = $input['potential-gender'];
            $profile->start_date_rug = $input['potential-study-year'];

            $profile->parent_phone = $input['parents-phone'];
            $profile->parent_address = $input['parents-address'];
            $profile->parent_zip_code = $input['parents-zip-code'];
            $profile->parent_town = $input['parents-town'];

            $profile->save();

            $user->type = 1;
            $user->save();

            $this->layout->content = View::make('word-lid.lid-geworden');

        } else {
            return Redirect::back()->withInput()->withErrors($validation);
        }
    }

    public function postRegister()
    {
        $input = Input::all();
        $rules = [
            'register-username' => 'required|unique:users,username',
            'register-firstname' => 'required',
            'register-lastname' => 'required',
            'register-email' => 'required|email|unique:users,email',
            'register-password' => 'required|confirmed'
        ];

        $validation = Validator::make($input, $rules);

        if($validation->passes())
        {
            $user = GSVnet\Users\User::create(array(
                'firstname' => $input['register-firstname'],
                'middlename' => Input::get('register-middlename', ''),
                'lastname' => $input['register-lastname'],
                'email' => $input['register-email'],
                'username' => $input['register-username'],
                'password' => $input['register-password'],
                'type' => 0
            ));

            // Log the user immediately in
            Auth::login($user);

            // Potentials should return to the become member form
            if(Input::has('become-member-register'))
            {
                return Redirect::to(URL::action('HomeController@wordLid') . '#become-member')
                    ->withInput()->withErrors($validation);
            }

            // TODO waar moet de registratiereturn heen?
            return Redirect::to('/');
        }

        if(Input::has('become-member-register'))
        {
            return Redirect::to(URL::action('HomeController@wordLid') . '#register-form')
                ->withInput()->withErrors($validation);
        }

        return Redirect::back()->withInput()->withErrors($validation);
    }

    public function showRegister()
    {
        $this->layout->bodyID = 'show-register';
        $this->layout->layout = View::make('users.register');
    }
}