<?php

return array(
	'title' => 'Agenda',
	'single' => 'evenement',
	'model' => 'Model\Event',

	'columns' => array(
		'start_date' => array(
			'title' => 'Begin'
		)
	),

	'edit_fields' => array(
		'start_date' => array(
			'title' => 'Begin',
			'type' => 'date'
		)
	)
);
?>