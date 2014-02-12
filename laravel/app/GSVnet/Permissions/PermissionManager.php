<?php namespace GSVnet\Permissions;

class PermissionManager implements PermissionManagerInterface
{
    protected $managers;

    public function addManager(PermissionManagerInterface $manager)
    {
        $managers[] = $manager;
    }

    // protected $user;

    // public function __construct(User $user)
    // {

    // }

    public function has($permission)
    {
        foreach ($this->managers as $manager)
        {
            if $manager->has($permission) return true;
        }
        return false;
    }
}