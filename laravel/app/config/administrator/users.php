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
		),
		'telephone' => array(
			'title' => 'Telefoon'
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
		'telephone' => array(
			'title' => 'Telefoon',
			'type' => 'text'
		),
		'password' => array(
			'title' => 'Wachtwoord',
			'type' => 'password'
		)
	)
);
?>