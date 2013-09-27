<?php

return array(
    'title' => 'GSV-profiel',
    'single' => 'profiel',
    'model' => 'Model\UserProfile',

    'columns' => array(
        'firstname' => array(
            'title' => 'Voornaam'
        ),
        'lastname' => array(
            'title' => 'Achternaam'
        ),
        'phone' => array(
            'title' => 'Telefoon'
        ),
        'year_group' => array(
            'title' => 'Jaarverband',
            'relationship' => 'yearGroup',
            'select' => '(:table).name'
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
        'phone' => array(
            'title' => 'Telefoon',
            'type' => 'text'
        ),
        'yearGroup' => array(
            'type' => 'relationship',
            'title' => 'Jaarverband',
            'name_field' => 'name', //using the getFullNameAttribute accessor
            //'options_sort_field' => "firstname",
        )
    )
);
?>