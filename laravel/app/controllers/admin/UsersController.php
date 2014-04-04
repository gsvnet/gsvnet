<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserValidator;
use GSVnet\Users\UserManager;

class UsersController extends BaseController {

    protected $users;
    protected $validator;

    public function __construct(
        UserManager $userManager,
        UserValidator $validator,
        UsersRepository $users)
    {
        $this->userManager = $userManager;
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
        $users = $this->users->paginateLatelyRegistered(20);

        $this->layout->content = View::make('admin.users.index')
            ->withUsers($users);
    }

    public function showGuests()
    {
        $users = $this->users->paginateWhereType(0, 30);

        $this->layout->content = View::make('admin.users.index')
            ->with(['users' => $users]);
    }

    public function showPotentials()
    {
        $users = $this->users->paginateWhereType(1, 30);

        $this->layout->content = View::make('admin.users.index')
            ->with(['users' => $users]);
    }

    public function showMembers()
    {
        $users = $this->users->paginateWhereType(2, 30);

        $this->layout->content = View::make('admin.users.index')
            ->with(['users' => $users]);
    }

    public function showFormerMembers()
    {
        $users = $this->users->paginateWhereType(3, 30);

        $this->layout->content = View::make('admin.users.index')
            ->with(['users' => $users]);
    }

    public function create()
    {
        $this->layout->content = View::make('admin.users.create');
    }

    public function store()
    {
        $input = Input::all();
        $input['public'] = Input::get('public', false);

        $this->validator->validate($input);
        $user = $this->users->create($input);

        $message = '<strong>' . $user->name . '</strong> is succesvol opgeslagen.';
        return Redirect::action('Admin\UsersController@index')
            ->withMessage($message);
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

        $this->validator->validate($input);
        $user = $this->users->update($id, $input);

        $message = '<strong>' . $user->name . '</strong> is succesvol bewerkt.';
        return Redirect::action('Admin\UsersController@show', $id)
            ->withMessage($message);
    }

    public function destroy($id)
    {
        $user = $this->users->delete($id);

        return Redirect::action('Admin\UsersController@index')
            ->with('message', '<strong>' . $user->name . '</strong> is succesvol verwijderd.');
    }

    public function activate($id)
    {
        $user = $this->userManager->activateUser($id);

        return Redirect::action('Admin\UsersController@index')
            ->with('message', '<strong>' . $user->full_name . '</strong> is succesvol geactiveerd.');
    }

    public function accepted($id)
    {
        $user = $this->userManager->acceptedUser($id);

        return Redirect::action('Admin\UsersController@index')
            ->with('message', '<strong>' . $user->name . '</strong> is succesvol geaccepteerd.');
    }


}