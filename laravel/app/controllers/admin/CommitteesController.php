<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Committees\CommitteesRepository;
use GSVnet\Committees\CommitteeValidator;

use GSVnet\Users\UsersRepositoryInterface;

use GSVnet\Core\Exceptions\ValidationException;

class CommitteeController extends BaseController {

    protected $committees;
    protected $users;
    protected $validator;

    public function __construct(
        CommitteesRepository $committees,
        CommitteeValidator $validator,
        UsersRepositoryInterface $users)
    {
        $this->committees = $committees;
        $this->validator = $validator;
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
        $users = $this->users->all();

        $this->layout->content = View::make('admin.committees.index')
            ->withCommittees($committees)
            ->withUsers($users);
    }

    public function store()
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        try
        {
            $this->validator->validate($input);
            $committee = $this->committees->create($input);

            $message = '<strong>' . $committee->name . '</strong> is succesvol opgeslagen.';
            return Redirect::action('Admin\CommitteeController@index')
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\CommitteeController@index')
                ->withInput()
                ->withErrors($e->getErrors());
        }
    }

    public function show($id)
    {
        $committee = $this->committees->byId($id);

        $members = $this->committees->members($id);

        // TODO: filter current members
        $users = $this->users->all();

        // $users = $users->filter(function($user) use ($members)
        // {
        //     if ($members->contains($user->id))
        //         return false;
        //     return true;
        // });


        // Select the user's fullname as we're only interested in that
        // $users = $users->map(function($user)
        // {
        //     return ['user' => $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname];
        // });

        $this->layout->content = View::make('admin.committees.show')
            ->withCommittee($committee)
            ->withUsers($users)
            ->withMembers($members);
    }

    public function edit($id)
    {
        $committee = $this->committees->byId($id);
        $users = $this->users->all();

        // Dit moet eigenlijk via een repository
        $members = $committee->users;

        // Wat uitprobeersels
        // $new = $users->filter(function($user) use ($members)
        // {
        //     if ($members->contains($user->id))
        //         return true;
        // });
        // dd($users->intersect($members)->toArray());
        // dd($new->toArray());


        $this->layout->content = View::make('admin.committees.edit')
            ->withCommittee($committee)
            ->withUsers($users)
            ->withMembers($members);
    }

    public function update($id)
    {
        $input = Input::all();

        try
        {
            $this->validator->validate($input);
            $committee = $this->committees->update($id, $input);

            $message = '<strong>' . $committee->name . '</strong> is succesvol bewerkt.';
            return Redirect::action('Admin\CommitteeController@show', $id)
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\CommitteeController@edit', $id)
                ->withInput()
                ->withErrors($e->getErrors());
        }
    }

    public function destroy($id)
    {
        $committee = $this->committees->delete($id);

        return Redirect::action('Admin\CommitteeController@index')
            ->with('message', '<strong>' . $committee->name . '</strong> is succesvol verwijderd.');
    }
}