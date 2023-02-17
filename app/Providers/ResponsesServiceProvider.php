<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\Facades\Image;
use Response;

class ResponsesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->inlinePhoto();
        $this->csv();
    }

    public function register(): void
    {
    }

    private function inlinePhoto()
    {
        Response::macro('inlinePhoto', function ($path, $name = null) {
            $image = Image::make($path);
            $response = $image->response();

            if (is_null($name)) {
                $name = basename($path);
            }

            $filetime = filemtime($path);
            $etag = md5($filetime.$path);
            $time = gmdate('r', $filetime);
            // Keep images 1 month
            $lifetime = 60 * 60 * 24 * 30;
            $expires = gmdate('r', $filetime + $lifetime);
            // $expires = '+1 month';
            $length = filesize($path);

            $headers = [
                'Content-Disposition' => 'inline; filename="'.$name.'"',
                'Last-Modified' => $time,
                'Cache-Control' => 'must-revalidate',
                'Expires' => $expires,
                'Pragma' => 'public',
                'Etag' => $etag,
            ];
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
    }

    private function csv()
    {
        Response::macro('csv', function ($data, $filename = 'data.csv', $status = 200, $delimiter = ',', $linebreak = "\n", $headers = []) {
            return Response::stream(function () use ($data, $delimiter, $linebreak) {
                $i = 0;
                foreach ($data as $row) {
                    $keys = [];
                    $values = [];

                    foreach ($row as $k => $v) {
                        if ($i == 0) {
                            $keys[] = is_string($k) ? '"'.str_replace('"', '""', $k).'"' : $k;
                        }

                        $values[] = is_string($v) ? '"'.str_replace('"', '""', $v).'"' : $v;
                    }

                    if (count($keys) > 0) {
                        echo implode($delimiter, $keys).$linebreak;
                    }

                    if (count($values) > 0) {
                        echo implode($delimiter, $values).$linebreak;
                    }

                    $i++;
                }
            }, 200, array_merge([
                'Content-type' => 'text/csv; charset=utf-8',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => 'attachment; filename='.$filename,
                'Expires' => '0',
                'Pragma' => 'public',
            ], $headers));
        });
    }
}
