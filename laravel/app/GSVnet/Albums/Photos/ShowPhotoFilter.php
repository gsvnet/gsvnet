<?php

use Permission;

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
        if ( ! Permission::has('show.photo'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}