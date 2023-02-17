<?php

namespace Malfonds;

use App\Helpers\Users\YearGroupRepository;
use App\Helpers\Users\YearGroupTransformer;

class YearGroupController extends CoreApiController
{
    /**
     * @var YearGroupRepository
     */
    protected $groups;

    /**
     * YearGroupsController constructor.
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
