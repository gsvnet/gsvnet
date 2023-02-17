<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class SessionController extends BaseController
{
    public function postLogin()
    {
        $becomingMember = Request::has('become-member-login');

        // Get POST data
        $userdata = [
            'email' => Request::get('inputEmail'),
            'password' => Request::get('inputPassword'),
        ];

        // Attempt to login user else redirect as intended
        if (Auth::attempt($userdata, Request::get('remember', false))) {
            //For redirect
            $intended = URL::previous();

            // If becoming member, return correctly.
            if ($becomingMember) {
                $intended = URL::action([\App\Http\Controllers\MemberController::class, 'store']).'#lid-worden';
            }

            return redirect()->intended($intended);
        }

        // Auth failure! lets go back to the login
        if ($becomingMember) {
            return redirect(action([\App\Http\Controllers\MemberController::class, 'store']).'#login-form')->with('login_errors', true);
        }

        return redirect()->action([\App\Http\Controllers\SessionController::class, 'getLogin'])->with('login_errors', true);
    }

    public function getLogout(): RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }

    public function getLogin(): View
    {
        return view('users.login');
    }
}
