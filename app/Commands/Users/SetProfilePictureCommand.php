<?php

namespace App\Commands\Users;

use App\Helpers\Users\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SetProfilePictureCommand
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @var User
     */
    public $user;

    public $manager;

    /**
     * SetProfilePictureCommand constructor.
     *
     * @param  User  $user
     * @param  User  $manager
     * @param  UploadedFile  $file
     */
    public function __construct(User $user, User $manager, UploadedFile $file)
    {
        $this->user = $user;
        $this->file = $file;
        $this->manager = $manager;
    }

    public static function fromRequest(Request $request, User $user)
    {
        return new static($user, $request->user(), $request->file('photo_path'));
    }
}
