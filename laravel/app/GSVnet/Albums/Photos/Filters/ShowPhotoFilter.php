<?php namespace GSVnet\Albums\Photos\Filters;

use Permission;
use GSVnet\Albums\Photos\PhotoRepositoryInterface;

Class ShowPhotoFilter
{
    protected $photos;

    public function __construct(PhotoRepositoryInterface $photos)
    {
        $this->photos = $photos;
    }

    public function filter($route)
    {
        $id     = $route->getParameter('photo');
        $photo  = $this->photos->byId($id);
        if ($photo->public) return;
        if ( ! Permission::has('photo.show'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}