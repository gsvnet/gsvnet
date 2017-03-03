<?php namespace Malfonds;
use GSVnet\Users\YearGroupRepository;
use GSVnet\Users\YearGroupTransformer;

class YearGroupController extends CoreApiController
{
    /**
     * @var YearGroupRepository
     */
    protected $groups;

    /**
     * YearGroupsController constructor.
     * @param YearGroupRepository $groups
     */
    public function __construct(YearGroupRepository $groups)
    {
        $this->groups = $groups;
    }

    public function index()
    {
        $this->authorize('users.show');
        $groups = $this->groups->all();
        
        return $this->withCollection($groups, new YearGroupTransformer);
    }

}