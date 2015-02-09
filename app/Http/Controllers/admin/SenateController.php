<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Senates\SenatesRepository;
use GSVnet\Senates\SenateValidator;
use GSVnet\Users\UsersRepository;

class SenateController extends AdminBaseController {

    protected $senates;
    protected $users;
    protected $validator;

    public function __construct(
        SenatesRepository $senates,
        SenateValidator $validator,
        UsersRepository $users)
    {
        $this->senates = $senates;
        $this->validator = $validator;
        $this->users = $users;

        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'delete']]);
        $this->beforeFilter('senates.create', ['on' => 'store']);
        $this->beforeFilter('senates.update', ['only' => ['update', 'edit']]);
        $this->beforeFilter('senates.delete', ['on' => 'destroy']);

        parent::__construct();
    }

    public function index()
    {
        $senates = $this->senates->paginate(20);
        $users = $this->users->all();

        $this->layout->content = View::make('admin.senates.index')
            ->withSenates($senates)
            ->withUsers($users);
    }

    public function store()
    {
        $input = Input::all();

        $this->validator->validate($input);
        $senate = $this->senates->create($input);

        $message = '<strong>' . $senate->name . '</strong> is succesvol opgeslagen.';
        return Redirect::action('Admin\SenateController@index')
            ->withMessage($message);

    }

    public function show($id)
    {
        $senate = $this->senates->byId($id);

        $members = $this->senates->members($id);

        $users = $this->users->all();
        $users = $users->map(function($user)
        {
            return [
                'id' => $user->id, 
                'name' => $user->present()->fullName
            ];
        });

        $this->layout->content = View::make('admin.senates.show')
            ->withSenate($senate)
            ->withUsers($users)
            ->withMembers($members);
    }

    public function edit($id)
    {
        $senate = $this->senates->byId($id);
        $members = $senate->members;

        $users = $this->users->all();
        $users = $users->map(function($user)
        {
            return [
                'id' => $user->id, 
                'name' => $user->present()->fullName
            ];
        });

        $this->layout->content = View::make('admin.senates.edit')
            ->withSenate($senate)
            ->withUsers($users)
            ->withMembers($members);
    }

    public function update($id)
    {
        $input = Input::all();
        $this->validator->validate($input);
        $senate = $this->senates->update($id, $input);

        $message = '<strong>' . $senate->name . '</strong> is succesvol bewerkt.';
        return Redirect::action('Admin\SenateController@show', $id)
            ->withMessage($message);
    }

    public function destroy($id)
    {
        $senate = $this->senates->delete($id);

        return Redirect::action('Admin\SenateController@index')
            ->with('message', '<strong>' . $senate->name . '</strong> is succesvol verwijderd.');
    }
}