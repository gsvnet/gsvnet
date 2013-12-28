<?php

class SessionController extends BaseController {

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
}
