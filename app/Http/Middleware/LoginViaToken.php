<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Auth\TokenRepository;
use Auth;
use Illuminate\Http\Request;

class LoginViaToken
{
    /**
     * @var TokenRepository
     */
    protected $tokens;

    /**
     * LoginViaToken constructor.
     *
     * @param  TokenRepository  $tokens
     */
    public function __construct(TokenRepository $tokens)
    {
        $this->tokens = $tokens;
    }

    public function handle(Request $request, \Closure $next): Response
    {
        $token = $request->header('X-Auth-Token');

        if ($token) {
            $this->maybeLoginViaToken($token);
        }

        return $next($request);
    }

    public function maybeLoginViaToken($tokenString)
    {
        $token = $this->tokens->getActiveToken($tokenString);

        if ($token) {
            Auth::loginUsingId($token->user_id);
        }
    }
}
