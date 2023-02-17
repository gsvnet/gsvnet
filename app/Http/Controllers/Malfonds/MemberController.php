<?php

namespace Malfonds;

use App\Commands\Members\ChangeAddress;
use App\Commands\Members\ChangeGender;
use App\Commands\Members\ChangeName;
use App\Commands\Members\ChangeYearGroup;
use App\Commands\Members\InviteMember;
use App\Commands\Users\ChangeEmail;
use App\Commands\Users\ChangePassword;
use App\Events\Members\Verifications\EmailWasVerified;
use App\Events\Members\Verifications\FamilyWasVerified;
use App\Events\Members\Verifications\GenderWasVerified;
use App\Events\Members\Verifications\NameWasVerified;
use App\Events\Members\Verifications\YearGroupWasVerified;
use App\Helpers\Auth\InviteValidator;
use App\Helpers\Auth\TokenRepository;
use App\Helpers\Auth\TokenTransformer;
use App\Helpers\Users\MemberTransformer;
use App\Helpers\Users\MemberTransformerWithoutYeargroup;
use App\Helpers\Users\UsersRepository;
use App\Helpers\Users\YearGroupRepository;
use Illuminate\Http\Request;

class MemberController extends CoreApiController
{
    /**
     * @var UsersRepository
     */
    protected $users;

    /**
     * @var TokenRepository
     */
    protected $tokens;

    /**
     * MemberController constructor.
     */
    public function __construct(UsersRepository $users, TokenRepository $tokens)
    {
        $this->users = $users;
        $this->tokens = $tokens;
    }

    public function index(Request $request)
    {
        if (! $request->filled('yearGroup')) {
            $this->errorBadRequest();
        }

        $members = $this->users->allOfYearGroup($request->get('yearGroup'));

        return $this->withCollection($members, new MemberTransformerWithoutYeargroup);
    }

    public function show($id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);

        return $this->withItem($member, new MemberTransformer);
    }

    public function me(Request $request)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($request->user()->id);

        return $this->withItem($member, new MemberTransformer);
    }

    public function updateName(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.name', $member);
        $command = ChangeName::fromForm($request, $member);
        $this->dispatch($command);

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer);
    }

    public function updateEmail(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.email', $member);
        $this->dispatch(ChangeEmail::fromForm($request, $member));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer);
    }

    public function updatePassword(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.password', $member);
        $this->dispatch(ChangePassword::fromForm($request, $member));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer);
    }

    public function updateAddress(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.address', $member);
        $this->dispatch(ChangeAddress::fromForm($request, $member));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer);
    }

    public function updateGender(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.gender', $member);
        $this->dispatch(ChangeGender::fromForm($request, $member));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer);
    }

    public function updateYearGroup(Request $request, YearGroupRepository $groups, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('formerMember.manage.year', $member);
        $yearGroup = $groups->byId($request->get('yearGroupId'));
        $this->dispatch(new ChangeYearGroup($member, $request->user(), $yearGroup));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer);
    }

    public function verifyName($id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.name', $member);
        event(new NameWasVerified($member, $member));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer());
    }

    public function verifyEmail($id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.email', $member);
        event(new EmailWasVerified($member, $member));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer());
    }

    public function verifyYearGroup($id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('formerMember.manage.year', $member);
        event(new YearGroupWasVerified($member, $member));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer());
    }

    public function verifyGender($id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.gender', $member);
        event(new GenderWasVerified($member, $member));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer());
    }

    public function verifyFamily($id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.name', $member);
        event(new FamilyWasVerified($member, $member));

        return $this->itemWasUpdated()->withItem($member, new MemberTransformer());
    }

    public function family($id)
    {
        $this->authorize('users.show');

        $you = $this->users->memberOrFormerByIdWithProfile($id);
        $children = $this->users->childrenWithProfileAndYearGroup($you);
        $parents = $this->users->parentsWithProfileAndYearGroup($you);

        $transform = $this->getFractalService();

        return $this->withArray([
            'children' => $transform->collection($children, new MemberTransformer),
            'parents' => $transform->collection($parents, new MemberTransformer),
        ]);
    }

    public function invite(Request $request, InviteValidator $validator, $userId)
    {
        $this->authorize('users.show');

        $member = $this->users->memberOrFormerByIdWithProfile($userId);
        $validator->validate($request->all());

        // Don't invite invited people or yourself for now...
        if ($member->isVerified() or $member->getKey() === $request->user()->getKey()) {
            return $this->errorBadRequest();
        }

        $this->dispatch(InviteMember::fromRequest($request, $request->user(), $member));

        return $this->itemWasCreated()->withArray();
    }

    public function requestInvite(Request $request, $userId)
    {
        $this->authorize('users.show');

        $member = $this->users->memberOrFormerByIdWithProfile($userId);

        if ($member->isVerified() or $member->getKey() === $request->user()->getKey()) {
            return $this->errorBadRequest();
        }

        $token = $this->tokens->getOrCreateFor($member);

        return $this->itemWasUpdated()->withItem($token, new TokenTransformer);
    }
}
