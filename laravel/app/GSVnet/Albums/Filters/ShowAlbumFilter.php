<?php namespace GSVnet\Albums\Filters;

use GSVnet\Albums\AlbumsRepository;
use Permission;

Class ShowAlbumFilter
{
    protected $albums;

    public function __construct(AlbumsRepository $albums)
    {
        $this->albums  = $albums;
    }

    public function filter($route)
    {
        $id     = $route->getParameter('album');

        $albums = $this->albums->byId($id);
        if ($albums->public) return;
        if ( ! Permission::has('album.show'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}