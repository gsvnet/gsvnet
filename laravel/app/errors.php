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