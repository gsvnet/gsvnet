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

        parent::__construct();
    }

    public function index()
    {
        $senates = $this->senates->paginate(20);
        $users = $this->users->all();

        return view('admin.senates.index')
            ->withSenates($senates)
            ->withUsers($users);
    }

    public function store()
    {
        $input = Input::all();

        $this->validator->validate($input);
        $senate = $this->senates->create($input);

        $message = '<strong>' . $senate->name . '</strong> is succesvol opgeslagen.';
        return redirect()->action('Admin\SenateController@index')
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

        return view('admin.senates.show')
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

        return view('admin.senates.edit')
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
        return redirect()->action('Admin\SenateController@show', $id)
            ->withMessage($message);
    }

    public function destroy($id)
    {
        $senate = $this->senates->delete($id);

        return redirect()->action('Admin\SenateController@index')
            ->with('message', '<strong>' . $senate->name . '</strong> is succesvol verwijderd.');
    }
}