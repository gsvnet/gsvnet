<?php namespace Admin\Committees;

use GSVnet\Committees\CommitteesRepositoryInterface;
use GSVnet\Users\UsersRepositoryInterface;

use Admin\BaseController;
use Redirect, Input, View;

class MembersController extends BaseController {


    protected $committees;
    protected $users;

    public function __construct(
        CommitteesRepositoryInterface $committees,
        UsersRepositoryInterface $users)
    {
        $this->committees = $committees;
        $this->users = $users;

        parent::__construct();
    }

    public function store($committee)
    {
        $input = Input::all();

        $member_id = $input['member_id'];
        $committee = $this->committees->byId($committee);
        $member = $this->users->byId($member_id);

        $committee->members()->attach($input['member_id'],  [
            'start_date' => $input['start_date'],
            'end_date' => null
        ]);

        $message = "$member->full_name succesvol toegevoegd aan $committee->name";
        return Redirect::action('Admin\CommitteeController@show', $committee->id)
            ->withMessage($message);
    }

    public function destroy($committee, $member)
    {
        $member = $this->users->byId($member);
        $committee = $this->committees->byId($committee);
        $committee->members()->detach($member->id);

        $message = '<strong>' . $member->full_name . '</strong> is succesvol verwijderd.';
            return Redirect::action('Admin\CommitteeController@show', $committee->id)
                ->withMessage($message);
    }
}