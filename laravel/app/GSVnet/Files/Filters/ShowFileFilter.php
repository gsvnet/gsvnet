<?php namespace GSVnet\Files\Filters;

use Permission;

class ShowFileFilter {

    public function filter($route)
    {
        if ( ! Permission::has('docs.show'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}