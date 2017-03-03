<?php namespace Malfonds;

use GSV\Commands\Members\InviteMember;
use GSVnet\Auth\InviteValidator;
use GSVnet\Auth\Token;
use GSVnet\Auth\TokenRepository;
use GSVnet\Core\Exceptions\ValidationException;
use GSVnet\Users\UsersRepository;
use Former;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

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
        $token = $this->tokens->getActiveByUserId($userId);

        if ($token) {
            $token->prolong();
        } else {
            $token = Token::initiateFor($member);
        }

        $this->tokens->save($token);
        return redirect(action('Malfonds\InvitationController@create', $userId));
    }

    public function inviteByMail(Request $request, InviteValidator $validator, $userId)
    {
        $this->authorize('users.show');

        $member = $this->users->memberOrFormerByIdWithProfile($userId);
        $validator->validate($request->all());

        // Don't invite invited people or yourself for now...
        if ($member->isVerified() or $member->getKey() === $request->user()->getKey()) {
            throw new ValidationException(new MessageBag([
                'verified' => 'Al geverifieerd'
            ]));
        }

        $this->dispatch(InviteMember::fromRequest($request, $request->user(), $member));

        flash()->success('Uitnodiging verstuurd!');

        return redirect(action('Admin\UsersController@show', $userId));
    }
}