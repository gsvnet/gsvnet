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
			'relationship' => 'user_profiles',
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
		
		'user_profiles' => array(
			'type' => 'relationship',
			'title' => 'Leden'
		)
	)
);
?>