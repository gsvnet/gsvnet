<?php

Class ShowPhotoFilter
{
    protected $manager;
    protected $photos;

    public function __construct(PermissionManager $manager, PhotoRepositoryInterface $photos)
    {
        $this->manager = $manager;
        $this->photos = $photos;
    }

    public function filter($route)
    {
        $id     = $route->getParameter('photo');
        $photo  = $this->photos->byId($id);
        if ($photo->public) return;
        if ( ! $manager->has('show.photo'))
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
    }
}