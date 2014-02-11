<?php namespace GSVnet\Albums;

use GSVnet\Albums\AlbumsRepositoryInterface;
use Permission;

Class ShowAlbumFilter
{
    protected $albums;

    public function __construct(AlbumsRepositoryInterface $albums)
    {
        $this->albums  = $albums;
    }

    public function filter($route)
    {
        $id     = $route->getParameter('album');
        $albums = $this->albums->bySlug($id);
        if ($albums->public) return;
        if ( ! Permission::has('show.album'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}