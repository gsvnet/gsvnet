<?php namespace Admin\Senates;

use GSVnet\Senates\SenatesRepository;
use GSVnet\Users\UsersRepository;

use Admin\AdminBaseController;
use Redirect, Input, View;

class MembersController extends AdminBaseController {


    protected $senates;
    protected $users;

    public function __construct(
        SenatesRepository $senates,
        UsersRepository $users)
    {
        $this->senates = $senates;
        $this->users = $users;
        $this->authorize('senates.manage');

        parent::__construct();
    }

    public function store($senate)
    {
        $input = Input::all();

        $member_id = $input['member'];
        $senate = $this->senates->byId($senate);
        $member = $this->users->byId($member_id);

        $senate->members()->attach($member_id,  [
            'function' => $input['function']
        ]);

        flash()->success("{$member->present()->fullName} succesvol toegevoegd aan {$senate->name}");

        return redirect()->action('Admin\SenateController@show', $senate->id);
    }

    public function destroy($senate, $member)
    {
        $member = $this->users->byId($member);
        $member->senates()->detach($senate);

        flash()->success("{$member->present()->fullName} succesvol uit de senaat geknikkerd");

        return redirect()->action('Admin\SenateController@show', $senate);
    }
}