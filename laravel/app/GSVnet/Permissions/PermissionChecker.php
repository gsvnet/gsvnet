<?php namespace GSVnet\Permissions;

class PermissionChecker
{
    protected $manager;

    /**
    *
    *   @param PermissionManager $manager
    */
    public function __construct(PermissionManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function check(PermissionInterface $permission)
    {
        if (! $permission->check($this->manager))
        {
            throw new NoPermissionException;
        }
        return true;
    }

    // Hier een string??
    public function has($permission)
    {
        return $this->manager->has($permission);
    }
}