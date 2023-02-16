<?php

namespace Admin;

use App\Helpers\Committees\CommitteeCreatorValidator;
use App\Helpers\Committees\CommitteesRepository;
use App\Helpers\Committees\CommitteeUpdaterValidator;
use App\Helpers\Users\UsersRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CommitteeController extends AdminBaseController
{
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
        $this->authorize('committees.manage');

        parent::__construct();
    }

    public function index(): View
    {
        $committees = $this->committees->paginate(100);
        $users = $this->users->byType(2);

        return view('admin.committees.index')
            ->with('committees', $committees)
            ->with('users', $users);
    }

    public function store(): RedirectResponse
    {
        $input = Request::only('name', 'description');
        $input['public'] = Request::get('public', false);
        $input['unique_name'] = Str::slug(Request::get('unique_name'));

        $this->creatorValidator->validate($input);
        $committee = $this->committees->create($input);

        flash()->success("Commissie {$committee->name} is succesvol opgeslagen");

        return redirect()->action([\App\Http\Controllers\Admin\CommitteeController::class, 'index']);
    }

    public function show($id)
    {
        $committee = $this->committees->byId($id);
        $members = $committee->members;

        $users = $this->users->all();
        $users = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->firstname.' '.$user->middlename.' '.$user->lastname,
            ];
        });

        return view('admin.committees.show')
            ->with('committee', $committee)
            ->with('users', $users)
            ->with('members', $members);
    }

    public function edit($id): View
    {
        $committee = $this->committees->byId($id);
        $members = $committee->users;

        return view('admin.committees.edit')
            ->with('committee', $committee)
            ->with('members', $members);
    }

    public function update($id): RedirectResponse
    {
        $input = Request::only('name', 'description');
        $input['id'] = $id;
        $input['public'] = Request::get('public', false);
        $input['unique_name'] = Str::slug(Request::get('unique_name'));

        $this->updaterValidator->forCommittee($id);
        $this->updaterValidator->validate($input);

        $committee = $this->committees->update($id, $input);

        flash()->success("{$committee->name} is succesvol bewerkt.");

        return redirect()->action([\App\Http\Controllers\Admin\CommitteeController::class, 'show'], $id);
    }

    public function destroy($id): RedirectResponse
    {
        $committee = $this->committees->delete($id);

        flash()->success("{$committee->name} is succesvol verwijderd.");

        return redirect()->action([\App\Http\Controllers\Admin\CommitteeController::class, 'index']);
    }
}
