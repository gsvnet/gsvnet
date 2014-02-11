<?php namespace GSVnet\Files\Filters;

use Permission;

class ShowFileFilter {

    public function filter($route)
    {
        if ( ! Permission::has('files.show'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}