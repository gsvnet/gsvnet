<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Users\UsersRepositoryInterface;
use GSVnet\Users\UserValidator;

use GSVnet\Core\Exceptions\ValidationException;

class UsersController extends BaseController {

    protected $users;
    protected $validator;

    public function __construct(
        UserValidator $validator,
        UsersRepositoryInterface $users)
    {
        $this->validator = $validator;
        $this->users = $users;

        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'delete']]);
        $this->beforeFilter('users.create', ['on' => 'store']);
        $this->beforeFilter('users.update', ['only' => ['update', 'edit']]);
        $this->beforeFilter('users.delete', ['on' => 'destroy']);

        parent::__construct();
    }

    public function index()
    {
        $users = $this->users->paginate(20);

        $this->layout->content = View::make('admin.users.index')
            ->withUsers($users);
    }

    public function create()
    {
        $this->layout->content = View::make('admin.users.create');
    }

    public function store()
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        try
        {
            $this->validator->validate($input);
            $user = $this->users->create($input);

            $message = '<strong>' . $user->name . '</strong> is succesvol opgeslagen.';
            return Redirect::action('Admin\UsersController@index')
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\UsersController@index')
                ->withInput()
                ->withErrors($e->getErrors());
        }
    }

    public function show($id)
    {
        $user = $this->users->byId($id);
        $profile = $user->profile;
        $committees = $user->committees;

        $this->layout->content = View::make('admin.users.show')
            ->withUser($user)
            ->withProfile($profile)
            ->withCommittees($committees);
    }

    public function edit($id)
    {
        $user = $this->users->byId($id);
        $users = $this->users->all();

        // Dit moet eigenlijk via een repository
        $members = $user->users;

        // Wat uitprobeersels
        // $new = $users->filter(function($user) use ($members)
        // {
        //     if ($members->contains($user->id))
        //         return true;
        // });
        // dd($users->intersect($members)->toArray());
        // dd($new->toArray());


        $this->layout->content = View::make('admin.users.edit')
            ->withUser($user)
            ->withUsers($users)
            ->withMembers($members);
    }

    public function update($id)
    {
        $input = Input::all();

        try
        {
            $this->validator->validate($input);
            $user = $this->users->update($id, $input);

            $message = '<strong>' . $user->name . '</strong> is succesvol bewerkt.';
            return Redirect::action('Admin\UsersController@show', $id)
                ->withMessage($message);
        }
        catch (ValidationException $e)
        {
            return Redirect::action('Admin\UsersController@edit', $id)
                ->withInput()
                ->withErrors($e->getErrors());
        }
    }

    public function destroy($id)
    {
        $user = $this->users->delete($id);

        return Redirect::action('Admin\UsersController@index')
            ->with('message', '<strong>' . $user->name . '</strong> is succesvol verwijderd.');
    }
}