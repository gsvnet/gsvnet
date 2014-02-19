<?php

App::error(function(GSVnet\Permissions\NoPermissionException $exception) {
    $data = [
        'title' => 'Helaas, u heeft niet voldoende rechten om deze pagina te bekijken.',
        'description' => '',
        'keywords' => ''
    ];

    return Response::view('errors.unauthorized', $data, 401);
});

// Dit is best wel lelijk en moet eigenlijk in een service provider oid

App::error(function(Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
    $data = array(
        'title' => 'Pagina niet gevonden - GSVnet',
        'description' => '',
        'keywords' => ''
    );

    return Response::view('errors.missing', $data, 404);
});

App::missing(function($exception) {
    $data = array(
        'title' => 'Pagina niet gevonden - GSVnet',
        'description' => '',
        'keywords' => ''
    );

    return Response::view('errors.missing', $data, 404);
});

App::error(function(GSVnet\Core\Exceptions\MaxUploadSizeException $exception)
{
    $message = 'Het bestand dat je hebt geprobeerd te uploaden is te groot.';
    return Redirect::back()->withInput()->withErrors($message);
});

App::error(function(Symfony\Component\HttpFoundation\File\Exception\FileException $e) {
   $message = 'Het bestand dat je hebt geprobeerd te uploaden is te groot.';
    return Redirect::back()->withInput()->withErrors($message);
});

App::error(function(GSVnet\Core\Exceptions\ValidationException $e) {
    return Redirect::back()
        ->withInput()
        ->withErrors($e->getErrors());
});

App::error(function(GSVnet\Files\FileStorageException $e) {
    return Redirect::back()
        ->withInput()
        ->withErrors("Er ging iets mis tijdens het uploaden, probeer het opnieuw. (misschien is het geuploade bestand te groot?)");
});

App::error(function(GSVnet\Albums\Photos\PhotoStorageException $e) {
    return Redirect::back()
        ->withInput()
        ->withErrors("Er ging iets mis tijdens het uploaden, probeer het opnieuw. (misschien is het geuploade bestand te groot?)");
});
