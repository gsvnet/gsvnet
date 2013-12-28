<?php

class UserController extends BaseController {

    public function postLogin()
    {
        // get POST data
        $userdata = array(
            'email'      => Input::get('inputEmail'),
            'password'   => Input::get('inputPassword')
        );

        if ( Auth::attempt($userdata) )
        {
            // we are now logged in, go to home
            return Redirect::to('/');
        }
        else
        {
            // auth failure! lets go back to the login
            return Redirect::to('/login')->with('login_errors', true);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function getLogin()
    {
        $this->layout->content = View::make('users.login');
    }

    /**
     * Show current and former members
     */
    public function showUsers()
    {
        $memberlist = Model\User::whereIn('type', array(3,4))
                                ->with('profile.yearGroup')
                                ->orderBy('lastname')
                                ->paginate(10);
        $this->layout->content = View::make('users.index')
            ->with('members', $memberlist);
    }

    public function showUser($id)
    {
        $member = Model\User::with('profile.yearGroup', 'committeesSorted')->find($id);
        

        //dd($member);

        $this->layout->content = View::make('users.profile')
            ->with('member', $member);
    }
}