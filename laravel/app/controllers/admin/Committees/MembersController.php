<?php namespace Admin\Committees;

use GSVnet\Committees\CommitteesRepository;
use GSVnet\Users\UsersRepository;
use GSVnet\Committees\MemberValidator;

use Admin\BaseController;
use Redirect, Input, View;

class MembersController extends BaseController {


    protected $committees;
    protected $users;
    protected $validator;

    public function __construct(
        CommitteesRepository $committees,
        UsersRepository $users,
        MemberValidator $validator)
    {
        $this->committees = $committees;
        $this->users = $users;
        $this->validator = $validator;

        parent::__construct();
    }

    public function store($committee)
    {
        $input = Input::only('member_id', 'start_date', 'end_date');
        $input['currently_member'] = Input::get('currently_member', '0');

        $this->validator->validate($input);

        if( $input['currently_member'] != '0' )
        {
            $input['end_date'] = null;
        }

        $member_id = $input['member_id'];
        $committee = $this->committees->byId($committee);
        $member = $this->users->byId($member_id);

        $committee->members()->attach($input['member_id'],  [
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date']
        ]);

        $message = "{$member->present()->fullName} succesvol toegevoegd aan {$committee->name}";
        return Redirect::action('Admin\CommitteeController@show', $committee->id)
            ->withMessage($message);
    }

    public function destroy($committee, $member)
    {
        $member = $this->users->byId($member);
        $committee = $this->committees->byId($committee);
        $committee->members()->detach($member->id);

        $message = '<strong>' . $member->present()->fullName . '</strong> is succesvol verwijderd.';
            return Redirect::action('Admin\CommitteeController@show', $committee->id)
                ->withMessage($message);
    }
}