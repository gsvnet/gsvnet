<?php namespace GSVnet\Permissions;

use Illuminate\Support\Facades\Facade;

class Permission extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'permission';
    }
}