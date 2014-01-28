<?php namespace GSVnet\Services;

use File;

// This class handles all file manipulation method
// It is made such that we can easily change the
class FileHandler
{
    protected $basePath;

    public function __construct($basePath = '')
    {
        $this->basePath = storage_path($basePath);
    }

    /**
    * Saves a file at the given location
    * @file file from Input::file()
    * @path string the location
    */
    public function make($file, $file)
    {
        // Create a unique filename
        $filename = time() . '-' . $file->getClientOriginalName();
        $relativePath = $path . $filename;
        // Move the file and restrict it's size
        $file = $file->move($this->basePath . $path, $filename);
        // Finaly return the new relativePath of the file
        return $relativePath;
    }

    /*
    * Get the file from the given path
    * @path string
    * @return file_contents
    */
    public function getPath($path)
    {
        return $path = $this->basePath . $path;

        // return File::get($path);
    }

    /**
    * Updates a file by first removing the old one and then making the new one
    * @file file from Input::file()
    * @path string the location
    */
    public function update($file, $path)
    {
        $this->destroy($path);
        $this->make($file, $path);
    }

    // ToDo: only dependent on the photo his location, not the model
    public function destroy($path)
    {
        // Delete old photo files
        if (File::exists($this->basePath . $path))
            File::delete($this->basePath . $path);
    }

    public function fileSize($path)
    {
        return filesize($this->basePath . $path);
    }

    public function extension($path)
    {
        return File::extension($this->basePath . $path);
    }
}