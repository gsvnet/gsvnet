<?php namespace GSVnet\Albums\Filters;

use Permission;

Class DeleteAlbumFilter
{
    public function filter($route)
    {
        if ( ! Permission::has('album.delete'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}