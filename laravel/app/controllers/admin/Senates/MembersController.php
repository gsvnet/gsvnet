<?php namespace Admin\Senates;

use GSVnet\Senates\SenatesRepository;
use GSVnet\Users\UsersRepository;

use Admin\BaseController;
use Redirect, Input, View;

class MembersController extends BaseController {


    protected $senates;
    protected $users;

    public function __construct(
        SenatesRepository $senates,
        UsersRepository $users)
    {
        $this->senates = $senates;
        $this->users = $users;

        parent::__construct();
    }

    public function store($senate)
    {
        $input = Input::all();

        $member_id = $input['member_id'];
        $senate = $this->senates->byId($senate);
        $member = $this->users->byId($member_id);

        $senate->members()->attach($input['member_id'],  [
            'function' => $input['function']
        ]);

        $message = "$member->fullName succesvol toegevoegd aan $senate->name";
        return Redirect::action('Admin\SenateController@show', $senate->id)
            ->withMessage($message);
    }

    public function destroy($senate, $member)
    {
        $member = $this->users->byId($member);
        $senate = $this->committees->byId($senate);
        $senate->members()->detach($member->id);

        $message = '<strong>' . $member->fullName . '</strong> is succesvol verwijderd.';
            return Redirect::action('Admin\SenateController@show', $senate->id)
                ->withMessage($message);
    }
}