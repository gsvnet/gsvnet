<?php namespace GSVnet\Albums\Photos;

use GSVnet\Albums\Photos\PhotoCreatorValidator;
use GSVnet\Albums\Photos\PhotoUpdatorValidator;

use GSVnet\Albums\Photos\ImageHandler;
use GSVnet\Albums\Photos\PhotosRepositoryInterface;

use GSVnet\Albums\Photos\PhotoStorageException;

class PhotoManager
{
    protected $createValidator;
    protected $updateValidator;
    protected $imageHandler;
    protected $photos;

    public function __construct(
        PhotoCreatorValidator $createValidator,
        PhotoUpdatorValidator $updateValidator,
        ImageHandler $imageHandler,
        PhotosRepositoryInterface $photos)
    {
        $this->imageHandler = $imageHandler;
        $this->createValidator = $createValidator;
        $this->updateValidator = $updateValidator;
        $this->photos = $photos;
    }

    /**
    * Validate input, create photo model and store photo file
    *
    * @param array $input
    * @return Photo
    */
    public function create(array $input)
    {
        $this->createValidator->validate($input);
        // Store the photo file and get its new path
        if (! $input['src_path'] = $this->imageHandler->make($input['photo'], "/uploads/images/album-" . $input['album_id'] . "/"))
        {
            throw new PhotoStorageException;
        }
        // If the photo was not given a name, use the file's name
        if (! (isset($input['name'])) || $input['name'] == '')
        {
            $input['name'] = $input['photo']->getClientOriginalName();
        }
        // Save the photo to the database
        return $this->photos->create($input);
    }

    /**
    * Validate input, update photo model and optionally update photo file
    *
    * @param array $input
    * @return Photo
    */
    public function update($id, array $input)
    {
        $this->updateValidator->validate($input);

        // Optionally update the photo's file
        if (isset($input['photo']))
        {
            // Delete the old photo file and store the new one
            $photo = $this->photos->byId($id);
            $this->imageHandler->destroy($photo->src_path);
            // Store the photo file and get its new path
            $input['src_path'] = $this->imageHandler->make(
                $input['photo'],
                "/uploads/images/album-" . $input['album_id'] . "/"
            );
            if (! $input['src_path'])
            {
                throw new PhotoStorageException;
            }
            // If the photo was not given a name, use the file's name
            if (! (isset($input['name'])) || $input['name'] == '')
            {
                $input['name'] = $input['photo']->getClientOriginalName();
            }
        }
        // Save the photo to the database
        return $this->photos->update($id, $input);
    }

    public function destroy($id)
    {
        $photo = $this->photos->delete($id);
        // Delete photo files
        $this->imageHandler->destroy($photo->src_path);

        return $photo;
    }
}