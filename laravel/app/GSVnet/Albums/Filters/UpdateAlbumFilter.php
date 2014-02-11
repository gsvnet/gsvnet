<?php namespace GSVnet\Albums\Filters;

use Permission;

Class UpdateAlbumFilter
{
    public function filter($route)
    {
        if ( ! Permission::has('album.update'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}