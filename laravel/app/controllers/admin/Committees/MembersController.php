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

    public function store()
    {
        dd(Inpug::all());

        $committee->attach($memberId,  [
            'start_date' => $input['start_date']
        ]);
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