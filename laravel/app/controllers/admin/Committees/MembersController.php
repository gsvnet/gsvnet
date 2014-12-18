<?php namespace Admin\Committees;

use GSVnet\Committees\CommitteesRepository;
use GSVnet\Committees\CommitteeMembership\CommitteeMembershipRepository;
use GSVnet\Committees\CommitteeMembership\MemberCreatorValidator;
use GSVnet\Committees\CommitteeMembership\MemberUpdaterValidator;
use GSVnet\Users\UsersRepository;

use Admin\AdminBaseController;
use Redirect, Input, View;

class MembersController extends AdminBaseController {


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

        parent::__construct();
    }

    public function store()
    {
        $input = Input::only('member_id', 'committee_id', 'start_date', 'end_date');
        $input['currently_member'] = Input::get('currently_member', '0');

        $this->creatorValidator->validate($input);

        if( $input['currently_member'] != '0' )
        {
            $input['end_date'] = null;
        }

        $committee = $this->committees->byId($input['committee_id']);
        $member = $this->users->byId($input['member_id']);

        $this->committeeMembership->create($member, $committee, $input);

        $message = "{$member->present()->fullName} succesvol toegevoegd aan {$committee->name}";
        return Redirect::action('Admin\CommitteeController@show', $committee->id)->withMessage($message);
    }

    public function destroy($id)
    {
        $membership = $this->committeeMembership->byId($id);
        $committee = $membership->committee;
        $member = $membership->member;

        $this->committeeMembership->delete($id);

        $message = '<strong>' . $member->present()->fullName . '</strong> succesvol verwijderd uit <strong>' . $committee->name . '</strong>';

        return Redirect::action('Admin\CommitteeController@show', $committee->id)->withMessage($message);
    }

    public function edit($id)
    {
        $membership = $this->committeeMembership->byId($id);
        $member = $membership->member;
        $committee = $membership->committee;

        $this->layout->content = View::make('admin.committees.edit-membership')
            ->withMembership($membership)
            ->withCommittee($committee)
            ->withMember($member);
    }

    public function update($id)
    {
        $input = Input::only('start_date', 'end_date');
        $input['currently_member'] = Input::get('currently_member', '0');

        $this->updaterValidator->validate($input);

        if( $input['currently_member'] != '0' )
        {
            $input['end_date'] = null;
        }

        $membership = $this->committeeMembership->byId($id);

        $user = $membership->member;
        $committee = $membership->committee;

        $this->committeeMembership->update($id, $input);
        
        $message = '<strong>' . $user->present()->fullName . '</strong> z\'n commissiewerk voor <strong>' . $committee->name . '</strong> is succesvol bijgewerkt.';
        
        return Redirect::action('Admin\CommitteeController@show', $committee->id)->withMessage($message);
    }
}