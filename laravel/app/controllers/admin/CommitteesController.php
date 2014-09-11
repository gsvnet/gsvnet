<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Committees\CommitteesRepository;
use GSVnet\Committees\CommitteeCreatorValidator;
use GSVnet\Committees\CommitteeUpdaterValidator;

use GSVnet\Users\UsersRepository;

class CommitteeController extends BaseController {

    protected $committees;
    protected $users;
    protected $creatorValidator;
    protected $updaterValidator;

    public function __construct(
        CommitteesRepository $committees,
        CommitteeCreatorValidator $creatorValidator,
        CommitteeUpdaterValidator $updaterValidator,
        UsersRepository $users)
    {
        $this->committees = $committees;
        $this->creatorValidator = $creatorValidator;
        $this->updaterValidator = $updaterValidator;
        $this->users = $users;

        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'delete']]);
        $this->beforeFilter('committees.create', ['on' => 'store']);
        $this->beforeFilter('committees.update', ['only' => ['update', 'edit']]);
        $this->beforeFilter('committees.delete', ['on' => 'destroy']);

        parent::__construct();
    }

    public function index()
    {
        $committees = $this->committees->paginate(20);
        $users = $this->users->byType(2);

        $this->layout->content = View::make('admin.committees.index')
            ->withCommittees($committees)
            ->withUsers($users);
    }

    public function store()
    {
        $input = Input::only('name', 'description');
        $input['unique_name'] = \Str::slug(Input::get('unique_name'));

        $this->creatorValidator->validate($input);
        $committee = $this->committees->create($input);

        $message = '<strong>' . $committee->name . '</strong> is succesvol opgeslagen.';
        return Redirect::action('Admin\CommitteeController@index')
            ->withMessage($message);

    }

    public function show($id)
    {
        $committee = $this->committees->byId($id);

        $members = $this->committees->members($id);

        // TODO: filter current members
        $users = $this->users->all();
        $users = $users->map(function($user)
        {
            return [
                'id' => $user->id, 
                'name' => $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname
            ];
        });

        $this->layout->content = View::make('admin.committees.show')
            ->withCommittee($committee)
            ->withUsers($users)
            ->withMembers($members);
    }

    public function edit($id)
    {
        $committee = $this->committees->byId($id);

        // Dit moet eigenlijk via een repository
        $members = $committee->users;

        $this->layout->content = View::make('admin.committees.edit')
            ->withCommittee($committee)
            ->withMembers($members);
    }

    public function update($id)
    {
        $input = Input::only('name', 'description');
        $input['id'] = $id;
        $input['unique_name'] = \Str::slug(Input::get('unique_name'));

        $this->updaterValidator->forCommittee($id);
        $this->updaterValidator->validate($input);
        
        $committee = $this->committees->update($id, $input);

        $message = '<strong>' . $committee->name . '</strong> is succesvol bewerkt.';
        return Redirect::action('Admin\CommitteeController@show', $id)
            ->withMessage($message);
    }

    public function destroy($id)
    {
        $committee = $this->committees->delete($id);

        return Redirect::action('Admin\CommitteeController@index')
            ->with('message', '<strong>' . $committee->name . '</strong> is succesvol verwijderd.');
    }
}