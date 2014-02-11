<?php namespace GSVnet\Albums\Photos\Filters;

use Permission;

Class CreatePhotoFilter
{
    public function filter($route)
    {
        if ( ! Permission::has('photo.create'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}