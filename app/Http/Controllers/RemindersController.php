<?php

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RemindersController extends BaseController
{
    use ResetsPasswords;

    protected $subject = 'Verander je wachtwoord op GSVnet';

    protected $redirectTo = '/';

    protected $auth;

    protected $passwords;

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
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('password.reset')->with('token', $token);
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->all(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = $this->passwords->reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);

            $user->save();

            $this->auth->login($user);
        });

        switch ($response) {
            case PasswordBroker::PASSWORD_RESET:
                return redirect($this->redirectPath());

            default:
                return redirect()->back()
                    ->withInput($request->all('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }
}
