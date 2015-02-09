<?php namespace GSVnet\Albums\Filters;

use Permission;

Class ManageAlbumsFilter
{
    public function filter($route)
    {
        if ( ! Permission::has('photos.manage'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}