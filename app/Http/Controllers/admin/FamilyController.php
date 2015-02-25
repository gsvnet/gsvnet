<?php namespace Admin;

use GSVnet\Users\UsersRepository;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;

class FamilyController extends AdminBaseController {

    private $users;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function index($userId)
    {
        $user = $this->users->byId($userId);
        $children = $user->children;
        $parent = $user->parents->first();

        return view('admin.family.index')->with('user', $user)
            ->with('children', $children)
            ->with('parent', $parent);
    }

    public function store($userId)
    {
        $parent = [Input::get('parentId')];
        $children = Input::get('childrenIds');

        if(!is_array($children))
            throw new ModelNotFoundException();

        $user = $this->users->byId($userId);
        $parentId = $this->users->filterExistingIds($parent);
        $childrenIds = $this->users->filterExistingIds($children);

        $user->parents()->sync($parentId);
        $user->children()->sync($childrenIds);

        $message = '<strong>Geukt!</strong>';
        return redirect()->back()->withMessage($message);
    }
}