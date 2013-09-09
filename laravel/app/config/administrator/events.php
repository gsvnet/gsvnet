<?php

return array(
	'title' => 'Agenda',
	'single' => 'evenement',
	'model' => 'Model\Event',

	'columns' => array(
		'title' => array(
			'title' => 'Titel'
		),
		'description' => array(
			'title' => 'Omschrijving'
		),
		'end_date' => array(
			'title' => 'Eind datum'
		),
		'start_date' => array(
			'title' => 'Begin datum'
		),
		'image' => array(
	        'title' => 'Image',
	        'output' => '<img src="/uploads/events/thumbs/small/(:value)" height="100" />',
	    ),
	),

	'edit_fields' => array(
		'title' => array(
			'title' => 'Titel',
		),
		'description' => array(
			'title' => 'Omschrijving',
			'type' => 'textarea'
		),
		'start_date' => array(
			'title' => 'Begin datum',
			'type' => 'date'
		),
		'end_date' => array(
			'title' => 'Eind datum',
			'type' => 'date'
		),

		'image' => array(
		    'title' => 'Image',
		    'type' => 'image',
		    'location' => public_path() . '/uploads/events/originals/',
		    'naming' => 'keep',
		    //'length' => 20,
		    'sizes' => array(
		        array(65, 57, 'crop', public_path() . '/uploads/events/thumbs/small/', 100),
		        array(220, 138, 'landscape', public_path() . '/uploads/events/thumbs/medium/', 100),
		        array(383, 276, 'fit', public_path() . '/uploads/events/thumbs/full/', 100)
		    )
		)
	)
);
?>