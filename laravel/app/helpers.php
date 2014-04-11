<?php

/**
*   Returns an image response
*
*   @param string $path
*   @param string $name
*   @return Response
*/
Response::macro('inlinePhoto', function($path, $name = null) {
    $image = Image::make($path);
    $response = $image->response();

    if (is_null($name)) {
        $name = basename($path);
    }

    $filetime = filemtime($path);
    $etag = md5($filetime . $path);
    $time = gmdate('r', $filetime);
    // Keep images 1 month
    $lifetime = 60*60*24*30;
    $expires = gmdate('r', $filetime + $lifetime);
    // $expires = '+1 month';
    $length = filesize($path);

    $headers = array(
        'Content-Disposition' => 'inline; filename="' . $name . '"',
        'Last-Modified' => $time,
        'Cache-Control' => 'must-revalidate',
        'Expires' => $expires,
        'Pragma' => 'public',
        'Etag' => $etag,
    );
    $headerTest1 = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $time;
    $headerTest2 = isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $etag;
    //image is cached by the browser, we dont need to send it again
    if ($headerTest1 || $headerTest2) {
        return Response::make('', 304, $headers);
    }

    foreach ($headers as $header => $value) {
        $response->header($header, $value);
    }

    return $response;
});