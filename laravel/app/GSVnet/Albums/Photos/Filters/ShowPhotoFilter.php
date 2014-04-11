<?php namespace GSVnet\Albums\Photos\Filters;

use Permission;
use GSVnet\Albums\Photos\PhotosRepository;

Class ShowPhotoFilter
{
    protected $photos;

    public function __construct(PhotosRepository $photos)
    {
        $this->photos = $photos;
    }

    public function filter($route)
    {
        $id     = $route->getParameter('id');
        $photo  = $this->photos->byId($id);
        if ($photo->album->public) return;
        if ( ! Permission::has('photos.show-private'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}