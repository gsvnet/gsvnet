<?php

namespace Admin;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Helpers\Users\UsersRepository;
use Illuminate\Support\Facades\Request;

class FamilyController extends AdminBaseController
{
    private $users;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
        $this->authorize('users.manage');
        parent::__construct();
    }

    public function index($userId): View
    {
        $user = $this->users->byId($userId);
        $children = $user->children;
        $parent = $user->parents->first();

        return view('admin.family.index')->with('user', $user)
            ->with('children', $children)
            ->with('parent', $parent);
    }

    public function store($userId): RedirectResponse
    {
        $parent = [Request::get('parentId')];
        $children = Request::get('childrenIds');
        $user = $this->users->byId($userId);

        if (is_array($children)) {
            $childrenIds = $this->users->filterExistingIds($children);
            $user->children()->sync($childrenIds->all());
        }

        $parentId = $this->users->filterExistingIds($parent);
        $user->parents()->sync($parentId->all());

        flash()->message("De familie van {$user->present()->fullName} is bijgewerkt");

        return redirect()->back();
    }
}
