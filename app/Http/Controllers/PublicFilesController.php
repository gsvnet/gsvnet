<?php

use GSVnet\Files\FileHandler;

// Did not really know where to put this single method, so I created a new controller.
class PublicFilesController extends BaseController {

    protected $fileHandler;
    protected $files;
    protected $labels;

// Perhaps this has to be coupled to the FilesRepository somewhere in the future. For now, this suffices.
    public function showPrivacyStatement(FileHandler $fileHandler)
    {
        $path = $fileHandler->getPath("/app/Privacy Statement GSV.pdf");

        return response()->download($path, "Privacy Statement GSV.pdf");
    }
}