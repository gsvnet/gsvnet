<?php

use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SessionController extends BaseController {

    private $cookie;

    function __construct(CookieJar $cookie)
    {
        $this->cookie = $cookie;
    }

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
            // Set cookie for logged in users. See CheckForCookie middleware
            $this->cookie->queue('logged-in', Auth::user()->id, 2628000);

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
        $this->cookie->forget('logged-in');
        return redirect('/');
    }

    public function getLogin()
    {
        return view('users.login');
    }
}
