<?php namespace GSVnet\Permissions;

// Hier een voorbeeld
class PhotoControllerExample
{
    public function __construct()
    {
        $this->beforeFilter(function() {
            Permission::check(new ShowPhotoPermission($id));
        }, ['only' => 'show']);
    }

    public function showPhoto($id)
    {
        // show photo
    }
}

// Of in een view:
@if (Permission::checkShowPhoto($id))

@endif