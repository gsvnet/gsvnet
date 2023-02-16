<?php

namespace Admin\Committees;

use Admin\AdminBaseController;
use App\Helpers\Committees\CommitteeMembership\CommitteeMembershipRepository;
use App\Helpers\Committees\CommitteeMembership\MemberCreatorValidator;
use App\Helpers\Committees\CommitteeMembership\MemberUpdaterValidator;
use App\Helpers\Committees\CommitteesRepository;
use App\Helpers\Users\UsersRepository;
use Illuminate\Support\Facades\Request;

class MembersController extends AdminBaseController
{
    protected $committees;

    protected $committeeMembership;

    protected $users;

    protected $creatorValidator;

    public function __construct(
        CommitteesRepository $committees,
        CommitteeMembershipRepository $committeeMembership,
        UsersRepository $users,
        MemberCreatorValidator $creatorValidator,
        MemberUpdaterValidator $updaterValidator)
    {
        $this->committees = $committees;
        $this->committeeMembership = $committeeMembership;
        $this->users = $users;
        $this->creatorValidator = $creatorValidator;
        $this->updaterValidator = $updaterValidator;

        $this->authorize('committees.manage');

        parent::__construct();
    }

    public function store()
    {
        $input = Request::only('member', 'committee_id', 'start_date', 'end_date');
        $input['currently_member'] = Request::get('currently_member', '0');

        $this->creatorValidator->validate($input);

        if ($input['currently_member'] != '0') {
            $input['end_date'] = null;
        }

        $committee = $this->committees->byId($input['committee_id']);
        $member = $this->users->byId($input['member']);

        $this->committeeMembership->create($member, $committee, $input);

        flash()->success("{$member->present()->fullName} succesvol toegevoegd aan {$committee->name}");

        return redirect()->action('Admin\CommitteeController@show', $committee->id);
    }

    public function destroy($id)
    {
        $membership = $this->committeeMembership->byId($id);
        $committee = $membership->committee;
        $member = $membership->member;

        $this->committeeMembership->delete($id);

        flash()->success("{$member->present()->fullName} succesvol verwijderd uit {$committee->name}");

        return redirect()->action('Admin\CommitteeController@show', $committee->id);
    }

    public function edit($id)
    {
        $membership = $this->committeeMembership->byId($id);
        $member = $membership->member;
        $committee = $membership->committee;

        return view('admin.committees.edit-membership')
            ->with('membership', $membership)
            ->with('committee', $committee)
            ->with('member', $member);
    }

    public function update($id)
    {
        $input = Request::only('start_date', 'end_date');
        $input['currently_member'] = Request::get('currently_member', '0');

        $this->updaterValidator->validate($input);

        if ($input['currently_member'] != '0') {
            $input['end_date'] = null;
        }

        $membership = $this->committeeMembership->byId($id);

        $user = $membership->member;
        $committee = $membership->committee;

        $this->committeeMembership->update($id, $input);

        flash()->success("{$user->present()->fullName} z'n commissiewerk voor {$committee->name} is succesvol bijgewerkt");

        return redirect()->action('Admin\CommitteeController@show', $committee->id);
    }
}
