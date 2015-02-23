<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Committees\CommitteesRepository;
use GSVnet\Committees\CommitteeCreatorValidator;
use GSVnet\Committees\CommitteeUpdaterValidator;

use GSVnet\Users\UsersRepository;

class CommitteeController extends AdminBaseController {

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

        parent::__construct();
    }

    public function index()
    {
        $committees = $this->committees->paginate(20);
        $users = $this->users->byType(2);

        return view('admin.committees.index')
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
        return redirect()->action('Admin\CommitteeController@index')
            ->withMessage($message);

    }

    public function show($id)
    {
        $committee = $this->committees->byId($id);
        $members = $committee->members;

        $users = $this->users->all();
        $users = $users->map(function($user){
            return [
                'id' => $user->id, 
                'name' => $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname
            ];
        });

        return view('admin.committees.show')
            ->withCommittee($committee)
            ->withUsers($users)
            ->withMembers($members);
    }

    public function edit($id)
    {
        $committee = $this->committees->byId($id);
        $members = $committee->users;

        return view('admin.committees.edit')
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
        redirect()->action('Admin\CommitteeController@show', $id)
            ->withMessage($message);
    }

    public function destroy($id)
    {
        $committee = $this->committees->delete($id);

        return redirect()->action('Admin\CommitteeController@index')
            ->with('message', '<strong>' . $committee->name . '</strong> is succesvol verwijderd.');
    }
}