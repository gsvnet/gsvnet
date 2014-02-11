<?php namespace GSVnet\Albums\Photos\Filters;

use Permission;

Class DeletePhotoFilter
{
    public function filter($route)
    {
        if ( ! Permission::has('photo.delete'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}