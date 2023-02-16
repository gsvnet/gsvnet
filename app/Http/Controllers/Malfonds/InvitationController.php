<?php

namespace Malfonds;

use App\Commands\Members\InviteMember;
use App\Helpers\Auth\InviteValidator;
use App\Helpers\Auth\Token;
use App\Helpers\Auth\TokenRepository;
use App\Helpers\Core\Exceptions\ValidationException;
use App\Helpers\Users\UsersRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\View\View;

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
     */
    public function __construct(UsersRepository $users, TokenRepository $tokens)
    {
        \Former::framework('TwitterBootstrap3');
        $this->users = $users;
        $this->tokens = $tokens;
    }

    public function create($userId): View
    {
        $this->authorize('users.show');
        $member = $this->users->memberOrFormerByIdWithProfile($userId);
        $token = $this->tokens->getActiveByUserId($userId);
        $this->authorize('member-or-reunist');

        return view('malfonds.invite', compact('member', 'token'));
    }

    public function store($userId): RedirectResponse
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

        return redirect(action([\App\Http\Controllers\Malfonds\InvitationController::class, 'create'], $userId));
    }

    public function inviteByMail(Request $request, InviteValidator $validator, $userId): RedirectResponse
    {
        $this->authorize('users.show');

        $member = $this->users->memberOrFormerByIdWithProfile($userId);
        $validator->validate($request->all());

        // Don't invite invited people or yourself for now...
        if ($member->isVerified() or $member->getKey() === $request->user()->getKey()) {
            throw new ValidationException(new MessageBag([
                'verified' => 'Al geverifieerd',
            ]));
        }

        $this->dispatch(InviteMember::fromRequest($request, $request->user(), $member));

        flash()->success('Uitnodiging verstuurd!');

        return redirect(action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $userId));
    }
}
