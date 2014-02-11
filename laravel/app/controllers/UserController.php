<?php

class UserController extends BaseController {
    /**
     * Show the curren user his profile
     */
    public function showProfile()
    {
        $member = Auth::user();

        $this->layout->content = View::make('users.profile')
            ->with('member', $member);
    }


    /**
     * Show current members
     */
    public function showUsers()
    {
        $member = Config::get('gsvnet.userTypes.member');
        //$formerMember = Config::get('gsvnet.userTypes.formerMember');
        $memberlist = Model\User::where('type', '=', $member)
                                ->with('profile.yearGroup')
                                ->orderBy('lastname')
                                ->paginate(200);

        $yearGroups = Model\YearGroup::orderBy('year', 'DESC')->get();

        $this->layout->content = View::make('users.index')
            ->with('members', $memberlist)
            ->with('yearGroups', $yearGroups);
    }

    public function showUser($id)
    {
        $member = Model\User::with('profile.yearGroup', 'committeesSorted')->find($id);


        //dd($member);

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
            $profile = Model\UserProfile::firstOrNew(array('user_id' => $user->id));
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
            $user = Model\User::create(array(
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
}