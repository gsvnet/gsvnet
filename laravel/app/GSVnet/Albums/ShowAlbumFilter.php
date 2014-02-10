<?php namespace GSVnet\Albums;

use GSVnet\Albums\AlbumsRepositoryInterface;
use GSVnet\Permissions\PermissionManagerInterface;

Class ShowAlbumFilter
{
    protected $manager;
    protected $albums;

    public function __construct(PermissionManagerInterface $manager, AlbumsRepositoryInterface $albums)
    {
        $this->manager = $manager;
        $this->albums  = $albums;
    }

    public function filter($route)
    {
        $id     = $route->getParameter('album');
        $albums = $this->albums->bySlug($id);
        if ($albums->public) return;
        if ( ! $this->manager->has('show.album'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}