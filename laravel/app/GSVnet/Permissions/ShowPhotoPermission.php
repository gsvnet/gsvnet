<?php namespace GSVnet\Permission;
// Dit is nog een voorbeeld
class ShowPhotoPermission implements PermissionInterface
{
    private $photo;
    private $photos;

    public function __construct($id, PhotoRepositoryInterface $photos)
    {
        $this->photos = $photos;
        $this->photo = $this->photos->byId($id);
    }

    public function check(PermissionManager $manager)
    {
        if ($photo->public) { return true }
        return $manager->has('show.photo');
    }
}