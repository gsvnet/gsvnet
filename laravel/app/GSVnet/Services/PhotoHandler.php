<?php namespace GSVnet\Services;

use File, Image;

class PhotoHandler
{
    private static $dimensions = [
        'small' => [308, 308],
        'wide' => [634, 308],
        'max' => [1024, 768]
    ];

    // Save a photo
    public function make($photo, $file)
    {
        $filename       = time() . '-' . $file->getClientOriginalName();
        $relativePath   =  '/uploads/photos/album-' . $album_id . '/';
        $album_id       = $photo->album_id;

        $file           = $file->move(storage_path() . $relativePath, $filename);

        $photo->src_path = $relativePath . $filename;
        return $photo;
    }

    // Get the photo corresponding to the given dimension
    public function get($photo, $dimension = 'full')
    {
        return Image::make(storage_path() . $this->grab($photo, $dimension));
        //return Image::make()
    }

    private function grab($photo, $dimension)
    {
        $orignalImagePath = storage_path() . $photo->src_path;
        $newPath = '';

        if (File::exists($orignalImagePath))
        {
            $ext = File::extension(storage_path() . $photo->src_path);
            if ($dimension != "full")
            {
                $newPath = str_replace('.' . $ext, '', $photo->src_path) . '-' . $dimension . '.' . $ext;
            }
            else
            {
                $newPath = str_replace('.' . $ext, '', $photo->src_path) . '.' . $ext;
            }

        }
        else
        {
            // We can't find the orignal image, thus we have to return the original image locatoin
            return $photo->src_path;
        }
        if (! File::exists(storage_path() . $newPath))
        {
            $img = Image::make($orignalImagePath);
            // Resize the image while maintaining correct aspect ratio
            $img->grab(self::$dimensions[$dimension][0], self::$dimensions[$dimension][1]);
            // finally we save the image as a new image
            $img->save(storage_path() . $newPath);
        }
        return $newPath;
    }

    private function restrictImageSize($photo)
    {
        $img = Image::make(storage_path() . $photo->src_path);

        if ($img->width > Self::$dimensions['max'][0] or
            $img->height > Self::$dimensions['max'][1])
        {
            // Resize the image while maintaining correct aspect ratio
            $img->grab(Self::$dimensions['max'][0], Self::$dimensions['max'][1]);
            // finally we save the image as a new image
            $img->save(storage_path() . $photo->src_path);
        }
    }
}