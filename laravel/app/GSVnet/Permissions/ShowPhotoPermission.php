<?php namespace GSVnet\Permissions;
// Dit is nog een voorbeeld
class ShowPhotoPermission implements PermissionInterface
{
    protected $photos;

    public function __construct(PhotoRepositoryInterface $photos)
    {
        $this->photos = $photos;
    }

    public function check($id, PermissionManager $manager)
    {
        $photo = $this->photos->byId($id);
        if ($photo->public) return true;
        return $manager->has('show.photo');
    }
}