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
		'username' => array(
			'title' => 'Gebruikersnaam',
			'type' => 'text'
		),
		'email' => array(
			'title' => 'Email'
		),
		'type' => array(
			'title' => 'Lid-type'
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
		'username' => array(
			'title' => 'Gebruikersnaam',
			'type' => 'text'
		),
		'email' => array(
			'title' => 'Email',
			'type' => 'text'
		),
		'password' => array(
			'title' => 'Wachtwoord',
			'type' => 'password'
		),
		'type' => array(
			'title' => 'Lid-type',
            'type' => 'enum',
            'options' => array(
                '0' => 'Bezoeker',
                '1' => 'Potential',
                '2' => 'Lid',
                '3' => 'Oud-lid'
            )
        )
	)
);
?>