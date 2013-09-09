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
		)
	),

	'edit_fields' => array(
		'title' => array(
			'title' => 'Titel',
		),
		'description' => array(
			'title' => 'Omschrijving',
		),
		'start_date' => array(
			'title' => 'Begin datum',
			'type' => 'date'
		),
		'end_date' => array(
			'title' => 'Eind datum',
			'type' => 'date'
		),
	)
);
?>