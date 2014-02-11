<?php namespace GSVnet\Albums\Photos\Filters;

use Permission;

Class UpdatePhotoFilter
{
    public function filter($route)
    {
        if ( ! Permission::has('photo.update'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}