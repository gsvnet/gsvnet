<?php

class UserController extends BaseController {

    public function post_login()
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
            return Redirect::to('/login')
                ->with('login_errors', true);
        }
    }

    public function get_logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function get_login()
    {
        $this->layout->content = View::make('users.login');
    }
}