<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SessionController extends BaseController {
    
    public function postLogin()
    {
        $becomingMember = Input::has('become-member-login');

        // Get POST data
        $userdata = array(
            'email'      => Input::get('inputEmail'),
            'password'   => Input::get('inputPassword')
        );

        // Attempt to login user else redirect as intended
        if (Auth::attempt($userdata, Input::get('remember', false)))
        {
            //For redirect
            $intended = URL::previous();

            // If becoming member, return correctly.
            if ($becomingMember)
                $intended = URL::action('MemberController@store') . '#lid-worden';

            return redirect()->intended($intended);
        }

        // Auth failure! lets go back to the login
        if ($becomingMember)
            return redirect(action('MemberController@store') . '#login-form')->with('login_errors', true);

        return redirect()->action('SessionController@getLogin')->with('login_errors', true);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getLogin()
    {
        return view('users.login');
    }
}
