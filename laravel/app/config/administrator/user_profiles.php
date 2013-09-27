<?php

return array(
    'title' => 'GSV-profiel',
    'single' => 'profiel',
    'model' => 'Model\UserProfile',

    'columns' => array(
        'firstname' => array(
            'title' => 'Naam',
            'relationship' => 'user',
            'select' => "(:table).firstname || ' ' || (:table).lastname" // CONCAT does not exist in sqlite?
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
        'user' => array(
            'type' => 'relationship',
            'title' => 'User',
            'name_field' => 'fullname'
        ),
        'phone' => array(
            'title' => 'Telefoonnummer',
            'type' => 'text'
        ),
        'address' => array(
            'title' => 'Adres',
            'type' => 'text'
        ),
        'zip_code' => array(
            'title' => 'Postcode',
            'type' => 'text'
        ),
        'town' => array(
            'title' => 'Woonplaats',
            'type' => 'text'
        ),
        'study' => array(
            'title' => 'Studie',
            'type' => 'text'
        ),
        'birthdate' => array(
            'title' => 'Geboortedatum',
            'type' => 'date'
        ),
        'church' => array(
            'title' => 'Kerk',
            'type' => 'text'
        ),
        'gender' => array(
            'title' => 'Man/vrouw',
            'type' => 'enum',
            'options' => array(
                '0' => 'Man',
                '1' => 'Vrouw'
            ),
        ),
        'start_date_rug' => array(
            'title' => 'Begin studie RuG',
            'type' => 'datetime'
        ),
        'parent_address' => array(
            'title' => 'Adres ouders',
            'type' => 'text'
        ),
        'parent_zip_code' => array(
            'title' => 'Postcode ouders',
            'type' => 'text'
        ),
        'parent_town' => array(
            'title' => 'Woonplaats ouders',
            'type' => 'text'
        ),
        'parent_phone' => array(
            'title' => 'Telefoonnummer ouders',
            'type' => 'text'
        ),
        'reunist' => array(
            'title' => 'Reünist',
            'type' => 'bool'
        ),
        'yearGroup' => array(
            'type' => 'relationship',
            'title' => 'Jaarverband',
            'name_field' => 'name'
        )
    ),

    'filters' => array(
        'user' => array(
            'type' => 'relationship',
            'title' => 'Name',
            'name_field' => 'firstname'
        )
    )
);
?>