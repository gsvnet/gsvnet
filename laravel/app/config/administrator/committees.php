<?php

return array(
    'title' => 'Commissies',
    'single' => 'comitee',
    'model' => 'Model\Committee',

    'columns' => array(
        'id' => array(
            'title' => 'ID',
        ),
        'name' => array(
            'title' => 'Titel'
        ),
        'description' => array(
            'title' => 'Omschrijving'
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