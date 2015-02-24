<?php

use Former\Facades\Former;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RemindersController extends BaseController {

    use ResetsPasswords;

    protected $subject = 'Verander je wachtwoord op GSVnet';
    protected $redirectTo = '/';

    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
    	parent::__construct();

        $this->auth = $auth;
        $this->passwords = $passwords;
    }

    public function getEmail()
    {
        return view('password.remind');
    }

    public function getReset($token = null)
    {
        if (is_null($token))
            throw new NotFoundHttpException;

        return view('password.reset')->with('token', $token);
    }
}