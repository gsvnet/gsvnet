<?php

return array(
    'title' => 'Gebruikers in commissies',
    'single' => 'lid',
    'model' => 'Model\CommitteeUser',

    'columns' => array(
        'committee' => array(
            'title' => 'Commissie',
            'relationship' => 'committee',
            'select' => '(:table).name'
        ),
        'user' => array(
            'title' => 'Gebruiker',
            'relationship' => 'user',
            'select' => "(:table).firstname || ' ' || (:table).lastname"
        ),
        'start_date' => array(
            'title' => 'Vanaf'
        ),
        'end_date' => array(
            'title' => 'Tot'
        )
    ),

    'edit_fields' => array(
        'user' => array(
            'type' => 'relationship',
            'title' => 'Gebruiker',
            'name_field' => 'fullname'
        ),
        'committee' => array(
            'type' => 'relationship',
            'title' => 'Commissie',
            'name_field' => 'name'
        ),
        'start_date' => array(
            'type' => 'date'
        ),
        'end_date' => array(
            'type' => 'date'
        )
    )
);
?>