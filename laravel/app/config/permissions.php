<?php
/**
*
*   Permission configuration
*   Permissions are configured such that if a user has one of the
*    then the user has the permission
*/
return [
    'member-or-former-member' => [
        'type' => ['member', 'formerMember']
    ],

    'photos.show-private' => [
        'type' => ['member', 'formerMember']
    ],

    'photos.manage' => [
        'committee' => [
            'web',
            'photo'
        ]
    ],

    'docs.show' => [
        'type' => ['member', 'formerMember']
    ],

    'docs.manage' => [
        'type' => ['member', 'formerMember']
    ],

    'docs.publish' => [
        'committee' => [
            'web'
        ]
    ],

    'events.show-private' => [
        'type' => ['member', 'formerMember'],
    ],

    'events.manage' => [
        'type' => ['member', 'formerMember'],
    ],

    'events.publish' => [
        'committee' => [
            'web'
        ]
    ],

    'admin' => [
        'committee' => [
            'web'
        ]
    ],

    'users.show' => [
        'type' => ['member', 'formerMember']
    ]
];