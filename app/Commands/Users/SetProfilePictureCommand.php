<?php namespace GSV\Commands\Users;

use GSVnet\Users\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SetProfilePictureCommand {

    public $file;
    public $user;

    public function __construct(User $user, UploadedFile $file)
    {
        $this->user = $user;
        $this->file = $file;
    }
}