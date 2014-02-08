<?php namespace GSVnet\Permission;

class PermissionChecker
{
    protected $manager;

    public function __construct(PermissionManager $manager)
    {
        $this->manager = $manager;
    }

    public function check(PermissionInterface $permission)
    {
        if (! $permission->check($this->manager))
        {
            throw new PermissionException;
        }
        return true;
    }
}