<?php namespace Malfonds;

use Auth;
use GSVnet\Auth\TokenRepository;
use Illuminate\Http\Request;

class SessionController extends MalfondsController
{
    /**
     * @var TokenRepository
     */
    private $tokens;

    /**
     * SessionController constructor.
     * @param TokenRepository $tokens
     */
    public function __construct(TokenRepository $tokens)
    {
        $this->tokens = $tokens;
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getLogin(Request $request)
    {
        $token = $request->get('token');
        if ($tokenModel = $this->tokens->getActiveToken($token)) {
            Auth::loginUsingId($tokenModel->user_id, $remember = true);

//            return redirect('/');
        }

        return view('malfonds.login');
    }
}