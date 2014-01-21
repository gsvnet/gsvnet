<?php namespace GSVnet\Services;
/*
/ The PhotoHandler class handles the storage n
*/
use File, Image;

class PhotoHandler
{
    private static $dimensions = [
        'small' => [308, 308],
        'wide' => [634, 308],
        'max' => [1024, 768]
    ];


    /**
    * Saves a photo at the given location
    * @file file from Input::file()
    * @path string the location
    */
    public function make($file, $path = '/uploads/photos/')
    {
        // Create a unique filename
        $filename = time() . '-' . $file->getClientOriginalName();
        $relativePath = $path . $filename;
        // Move the file and restrict it's size
        $file = $file->move(storage_path() . $path, $filename);
        $this->restrictImageSize($relativePath);
        // Finaly return the new relativePath of the file
        return $relativePath;
    }

    // Get the photo corresponding to the given dimension
    public function get($path, $dimension = '')
    {
        return Image::make(storage_path() . $this->grab($path, $dimension));
    }

    public function getStoragePath($path, $dimension = '')
    {
        return storage_path() . $this->grab($path, $dimension);
    }

    public function update($file, $path)
    {
        $this->destroy($path);
        return $this->make($file, $path);
    }

    // ToDo: only dependent on the photo his location, not the model
    public function destroy($path)
    {
        // Delete old photo files
        if (File::exists(storage_path() . $path))
            File::delete(storage_path() . $path);

        if (File::exists(storage_path() . $path . '-small'))
            File::delete(storage_path() . $path . '-small');

        if (File::exists(storage_path() . $path . '-wide'))
            File::delete(storage_path() . $path . '-wide');
    }


    /**
    * Either create or return the resized image of the original image
    * @param string $dimension either small or wide
    */
    private function grab($path, $dimension = '')
    {
        $fullPath = storage_path() . $path;

        // Check if we can find the original image's path, if not, throw an exception error
        if (! File::exists($fullPath))
        {
            //throw new PhotoFileNotFoundException;
            return 'error... hier moet nog iets goeds komen';
        }

        // Return the full path if we don't need a certain dimension
        if ($dimension == '')
        {
            return $path;
        }

        // Get the new filepath corresponding for the given dimension
        $ext     = File::extension(storage_path() . $path);
        $newPath = str_replace('.' . $ext, '', $path) . '-' . $dimension . '.' . $ext;

        // If we can't find the file, resize the original photo and return the new path
        if (! File::exists(storage_path() . $newPath))
        {
            $img = Image::make($fullPath);
            // Resize the image while maintaining correct aspect ratio
            $img->grab(self::$dimensions[$dimension][0], self::$dimensions[$dimension][1]);
            // finally we save the image as a new image
            $img->save(storage_path() . $newPath);
        }

        return $newPath;
    }

    private function restrictImageSize($path)
    {
        $img = Image::make(storage_path() . $path);
        // If the image which was found is larger than the given max dimensions, then resize it
        if ($img->width > Self::$dimensions['max'][0] or
            $img->height > Self::$dimensions['max'][1])
        {
            // Resize the image while maintaining correct aspect ratio
            $img->grab(Self::$dimensions['max'][0], Self::$dimensions['max'][1]);
            // finally we save the image as a new image
            $img->save(storage_path() . $path);
        }
    }

}