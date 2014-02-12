<?php namespace GSVnet\Albums\Photos;
/*
/ The ImageHandler class handles the storage n
*/
use File, Image, Config;
use Illuminate\Filesystem\Filesystem;

class ImageHandler
{
    // Base path kunnen we gebruiken om het pad waar de foto in opgeslagen moet worden alvast vast te zetten,
    // zodat we dan alleen nog maar de naam van een bestand hoeven te weten,
    // maar hier moet eerst nog wat beter over nageacht worden voordat we dat implementeren...
    protected $basePath;
    protected $filesystem;

    public function __construct($basePath = '', Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->basePath = storage_path($basePath);
    }

    /**
    * Saves a photo at the given location
    * @file file from Input::file()
    * @path string the location
    */
    public function make($file, $path = '/uploads/images/')
    {
        // Create a unique filename
        $filename = time() . '-' . $file->getClientOriginalName();
        $relativePath = $path . $filename;
        // Move the file and restrict it's size
        $file = $file->move($this->basePath . $path, $filename);
        $this->restrictImageSize($relativePath);
        // Finaly return the new relativePath of the file
        return $relativePath;
    }

    // Get the photo corresponding to the given dimension
    public function get($path, $dimension = '')
    {
        return Image::make($this->basePath . $this->grab($path, $dimension));
    }

    public function getStoragePath($path, $dimension = '')
    {
        return $this->basePath . $this->grab($path, $dimension);
    }

    // Update de foto, waarbij file weer een input bestand is, new path de plek waar de foto geplaatst moet worden
    // en path de plek van de oude foto
    // Dit wordt nu nog niet goed gebruikt
    public function update($file, $newPath, $path)
    {
        $this->destroy($path);
        return $this->make($file, $newPath);
    }

    // ToDo: only dependent on the photo his location, not the model
    public function destroy($path)
    {
        $ext  = File::extension($this->basePath . $path);
        $path = $this->basePath . str_replace('.' . $ext, '', $path);

        // Delete old photo files
        if (File::exists($path . '.' . $ext))
            File::delete($path . '.' . $ext);
        // ugh this does not work as there are exentions..
        if (File::exists($path . '-small' . '.' . $ext))
            File::delete($path . '-small' . '.' . $ext);

        if (File::exists($path . '-wide' . '.' . $ext))
            File::delete($path . '-wide' . '.' . $ext);
    }


    /**
    * Either create or return the resized image of the original image
    * @param string $dimension either small or wide
    */
    private function grab($path, $dimension = '')
    {
        $fullPath = $this->basePath . $path;

        // Check if we can find the original image's path, if not, throw an exception error
        if (! File::exists($fullPath))
        {
            throw new ImageFileNotFoundException;
            return 'error... hier moet nog iets goeds komen';
        }

        // Return the full path if we don't need a certain dimension
        if ($dimension == '')
        {
            return $path;
        }

        // Get the new filepath corresponding for the given dimension
        $ext     = File::extension($this->basePath . $path);
        $newPath = str_replace('.' . $ext, '', $path) . '-' . $dimension . '.' . $ext;

        // If we can't find the file, resize the original photo and return the new path
        if (! File::exists($this->basePath . $newPath))
        {
            $img = Image::make($fullPath);
            // Resize the image while maintaining correct aspect ratio
            $img->grab(Config::get('photos.dimensions')[$dimension][0], Config::get('photos.dimensions')[$dimension][1]);
            // finally we save the image as a new image
            $img->save($this->basePath . $newPath);
        }

        return $newPath;
    }

    /*
    * Restrict the image's size to a max width and height
    */
    private function restrictImageSize($path)
    {
        $img = Image::make($this->basePath . $path);
        // Get the max width and height
        $dimensions = Config::get('photos.dimensions.max');
        // If the image which was found is larger than the given max dimensions, then resize it
        if ($img->width > $dimensions[0] or
            $img->height > $dimensions[1])
        {
            // Resize the image while maintaining correct aspect ratio
            $img->grab($dimensions[0], $dimensions[1]);
            // finally we save the image as a new image
            $img->save($this->basePath . $path);
        }
    }

}