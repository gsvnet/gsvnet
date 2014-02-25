<?php

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
        if (Auth::attempt($userdata))
        {
            $intended = '/';
            // If becoming member, return correctly.
            if ($becomingMember)
            {
                $intended = URL::action('MemberController@wordLid') . '#become-member';
            }
            return Redirect::intended($intended);
        }

        // Auth failure! lets go back to the login
        if ($becomingMember)
        {
            return Redirect::to(URL::action('MemberController@wordLid') . '#login-form')->with('login_errors', true);
        }

        return Redirect::action('SessionController@getLogin')->with('login_errors', true);
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
}
