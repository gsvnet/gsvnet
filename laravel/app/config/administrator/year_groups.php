<?php

return array(
	'title' => 'Jaarverbanden',
	'single' => 'jaarverband',
	'model' => 'Model\YearGroup',

	'columns' => array(
		'name' => array(
			'title' => 'Naam'
		),
		'year' => array(
			'title' => 'Jaar'
		),
		'num_user_profiles' => array(
			'title' => 'Aantal leden',
			'relationship' => 'userProfiles',
			'select' => 'COUNT((:table).id)'
		)
	),

	'edit_fields' => array(
		'name' => array(
			'title' => 'Naam',
			'type' => 'text'
		),
		'year' => array(
			'title' => 'Jaar',
			'type' => 'number',
			'thousands_separator' => '' //optional, defaults to ','
		),

		'userProfiles' => array(
			'type' => 'relationship',
			'title' => 'Leden',
			'name_field' => 'fullname'
		)
	)
);
?>