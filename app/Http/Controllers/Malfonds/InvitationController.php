<?php namespace Malfonds;

use GSVnet\Auth\Token;
use GSVnet\Auth\TokenRepository;
use GSVnet\Users\UsersRepository;
use Former;

class InvitationController extends MalfondsController
{
    /**
     * @var UsersRepository
     */
    protected $users;
    /**
     * @var TokenRepository
     */
    private $tokens;

    /**
     * InvitationController constructor.
     * @param UsersRepository $users
     * @param TokenRepository $tokens
     */
    public function __construct(UsersRepository $users, TokenRepository $tokens)
    {
        \Former::framework('TwitterBootstrap3');
        $this->users = $users;
        $this->tokens = $tokens;
    }


    public function create($userId)
    {
        $this->authorize('users.show');
        $member = $this->users->memberOrFormerByIdWithProfile($userId);
        $token = $this->tokens->getActiveByUserId($userId);
        $this->authorize('member-or-former-member');
        return view('malfonds.invite', compact('member', 'token'));
    }
    
    public function store($userId)
    {
        $this->authorize('users.show');
        $member = $this->users->memberOrFormerByIdWithProfile($userId);
        $token = $this->tokens->getActiveByUserId($member);

        if ($token) {
            $token->prolong();
        } else {
            $token = Token::initiateFor($member);
        }

        $this->tokens->save($token);
        return redirect(action('Malfonds\InvitationController@create', $userId));
    }
}