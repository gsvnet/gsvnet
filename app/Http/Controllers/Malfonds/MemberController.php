<?php namespace Malfonds;

use GSV\Commands\Members\ChangeGender;
use GSV\Commands\Members\ChangeName;
use GSV\Commands\Members\ChangeYearGroup;
use GSV\Commands\Users\ChangeEmail;
use GSV\Commands\Users\ChangePassword;
use GSV\Events\Members\Verifications\EmailWasVerified;
use GSV\Events\Members\Verifications\FamilyWasVerified;
use GSV\Events\Members\Verifications\GenderWasVerified;
use GSV\Events\Members\Verifications\NameWasVerified;
use GSV\Events\Members\Verifications\YearGroupWasVerified;
use GSVnet\Users\MemberTransformer;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\YearGroupRepository;
use Illuminate\Http\Request;

class MemberController extends CoreApiController
{
    /**
     * @var UsersRepository
     */
    protected $users;

    /**
     * MemberController constructor.
     * @param UsersRepository $users
     */
    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function index()
    {

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
        $you = $this->users->memberOrFormerByIdWithProfile($id);
        $children = $this->users->childrenWithProfileAndYearGroup($you);
        $parents = $this->users->parentsWithProfileAndYearGroup($you);

        $transform = $this->getFractalService();
        
        return $this->withArray([
            'children' => $transform->collection($children, new MemberTransformer),
            'parents' => $transform->collection($parents, new MemberTransformer),
        ]);
    }
}