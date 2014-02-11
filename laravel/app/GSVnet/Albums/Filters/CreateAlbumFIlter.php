<?php namespace GSVnet\Albums\Filters;

use Permission;

Class CreateAlbumFilter
{
    public function filter($route)
    {
        if ( ! Permission::has('album.create'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}