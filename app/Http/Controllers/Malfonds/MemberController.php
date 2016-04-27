<?php namespace Malfonds;

use GSVnet\Users\MemberTransformer;
use GSVnet\Users\UsersRepository;

class MemberController extends CoreApiController
{
    /**
     * @var UsersRepository
     */
    protected $users;

    /**
     * MemberController constructor.
     * @param UsersRepository $users
     */
    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function index()
    {

    }

    public function show($id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);

        return $this->withItem($member, new MemberTransformer);
    }

    public function family($id)
    {
        $you = $this->users->memberOrFormerByIdWithProfile($id);
        $children = $this->users->childrenWithProfileAndYearGroup($you);
        $parents = $this->users->parentsWithProfileAndYearGroup($you);

        $transform = $this->getFractalService();
        
        return $this->withArray([
            'children' => $transform->collection($children, new MemberTransformer),
            'parents' => $transform->collection($parents, new MemberTransformer),
        ]);
    }
}