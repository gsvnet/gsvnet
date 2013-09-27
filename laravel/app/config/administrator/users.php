<?php

return array(
	'title' => 'Gebruikers',
	'single' => 'gebruiker',
	'model' => 'Model\User',

	'columns' => array(
		'firstname' => array(
			'title' => 'Voornaam'
		),
		'lastname' => array(
			'title' => 'Achternaam'
		),
		'email' => array(
			'title' => 'Email'
		)
	),

	'edit_fields' => array(
		'firstname' => array(
			'title' => 'Voornaam',
			'type' => 'text'
		),
		'lastname' => array(
			'title' => 'Achternaam',
			'type' => 'text'
		),
		'email' => array(
			'title' => 'Email',
			'type' => 'text'
		),
		'password' => array(
			'title' => 'Wachtwoord',
			'type' => 'password'
		)
	)
);
?>