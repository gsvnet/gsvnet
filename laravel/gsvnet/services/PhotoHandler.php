<?php namespace gsvnet/services

class PhotoHandler
{
    // Save a photo
    public function make($photo, $file)
    {
        $filename = time() . '-' . $file->getClientOriginalName();
        $rel_path =  '/uploads/photos/album-' . $album_id . '/';
        $album_id = $photo->album_id;

        $file = $file->move(storage_path() . $rel_path, $filename);

        $photo->src_path = $rel_path . $filename;

        $photo->restrictImageSize();

    }

    // Get the photo corresponding to the given dimension
    public function get($photo, $dimension = 'full')
    {

        //return Image::make()
    }

    private function grab($photo)
    {
        $orignalImagePath = storage_path() . $photo->src_path;
        $newPath = '';

        if (File::exists($orignalImagePath))
        {
            $ext = File::extension(storage_path() . $photo->src_path);
            $newPath = str_replace('.' . $ext, '', $photo->src_path) . '-' . $dimension . '.' . $ext;
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
}