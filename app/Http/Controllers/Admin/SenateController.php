<?php

namespace Admin;

use App\Helpers\Senates\SenatesRepository;
use App\Helpers\Senates\SenateValidator;
use App\Helpers\Users\UsersRepository;
use Illuminate\Support\Facades\Request;

class SenateController extends AdminBaseController
{
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
        $this->authorize('senates.manage');

        parent::__construct();
    }

    public function index()
    {
        $senates = $this->senates->paginate(20);
        $users = $this->users->all();

        return view('admin.senates.index')
            ->with('senates', $senates)
            ->with('users', $users);
    }

    public function store()
    {
        $input = Request::all();

        $this->validator->validate($input);
        $senate = $this->senates->create($input);

        flash()->success("{$senate->name} is succesvol opgeslagen.");

        return redirect()->action('Admin\SenateController@index');
    }

    public function show($id)
    {
        $senate = $this->senates->byId($id);
        $members = $this->senates->members($id);

        $users = $this->users->all();
        $users = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->present()->fullName,
            ];
        });

        return view('admin.senates.show')
            ->with('senate', $senate)
            ->with('users', $users)
            ->with('members', $members);
    }

    public function edit($id)
    {
        $senate = $this->senates->byId($id);
        $members = $senate->members;

        $users = $this->users->all();
        $users = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->present()->fullName,
            ];
        });

        return view('admin.senates.edit')
            ->with('senate', $senate)
            ->with('users', $users)
            ->with('members', $members);
    }

    public function update($id)
    {
        $input = Request::all();
        $this->validator->validate($input);
        $senate = $this->senates->update($id, $input);

        flash()->success("{$senate->name} is succesvol bewerkt.");

        return redirect()->action('Admin\SenateController@show', $id);
    }

    public function destroy($id)
    {
        $senate = $this->senates->delete($id);

        flash()->success("{$senate->name} is succesvol verwijderd.");

        return redirect()->action('Admin\SenateController@index');
    }
}
