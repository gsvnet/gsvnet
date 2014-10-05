<?php
return array(
	'mailgun' => [
		'domain' => $_ENV['mailgun.domain'],
		'secret' => $_ENV['mailgun.secret']
    ],

    'mandrill' => [
        'secret' => $_ENV['mandrill.secret']
    ]
);