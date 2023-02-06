<?php

namespace App\Http\Validators;

use GuzzleHttp\Client;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator){

        $client = new Client();

        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            ['body'=>
                [
                    'secret'=>env('G_RECAPTCHA_SECRET'),
                    'response'=>$value
                 ]
            ]
        );

        $body = json_decode((string)$response->getBody());
        return $body->success;
    }

}