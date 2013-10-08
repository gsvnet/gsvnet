<?php

return array(
    'title' => 'Commissies',
    'single' => 'comitee',
    'model' => 'Model\Committee',

    'columns' => array(
        'name' => array(
            'title' => 'Titel'
        ),
        'description' => array(
            'title' => 'Omschrijving'
        ),
        'num_users' => array(
            'title' => '# Leden',
            'relationship' => 'users', //this is the name of the Eloquent relationship method!
            'select' => "COUNT((:table).id)",
        )
    ),

    'edit_fields' => array(
        'name' => array(
            'title' => 'Titel',
        ),
        'description' => array(
            'title' => 'Omschrijving',
            'type' => 'textarea'
        )
    )
);
?>