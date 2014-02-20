<?php namespace GSVnet\Albums\Photos\Filters;

use Permission;

Class ManagePhotosFilter
{
    public function filter($route)
    {
        if ( ! Permission::has('photos.manage'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}