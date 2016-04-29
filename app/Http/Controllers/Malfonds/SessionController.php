<?php namespace Malfonds;

use GSVnet\Auth\TokenRepository;
use GSVnet\Users\MemberTransformer;
use GSVnet\Users\UsersRepository;
use Illuminate\Http\Request;
use Auth;

class SessionController extends CoreApiController
{
    /**
     * @var TokenRepository
     */
    protected $tokens;

    /**
     * @var UsersRepository
     */
    protected $users;

    /**
     * SessionController constructor.
     * @param TokenRepository $tokens
     * @param UsersRepository $users
     */
    public function __construct(TokenRepository $tokens, UsersRepository $users)
    {
        $this->tokens = $tokens;
        $this->users = $users;
    }

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password')))
        {
            $fractal = $this->getFractalService();
            $member = $this->users->memberOrFormerByIdWithProfile(Auth::user()->id);
            return $this->withArray([
                'token' => $this->tokens->getOrCreateFor(Auth::user()->id),
                'member' => $fractal->item($member, new MemberTransformer)
            ]);
        }

        return $this->errorBadRequest();
    }
}