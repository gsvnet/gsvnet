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

    'user.become-member' => [
        'type' => ['visitor']
    ],

    'users.manage' => [
        'committee' => ['webcie', 'novcie'],
        'senate' => true
    ],

    'committees.manage' => [
        'committee' => ['webcie'],
        'senate' => true
    ],

    'committees.show-novcie' => [
        'type' => ['member', 'formerMember']
    ],

    'photos.show-private' => [
        'type' => ['member', 'formerMember']
    ],

    'photos.manage' => [
        'committee' => [
            'webcie',
            'reebocie',
            'prescie'
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
            'webcie'
        ],
        'senate' => true
    ],

    'events.show-private' => [
        'type' => ['member', 'formerMember'],
    ],

    'events.manage' => [
        'type' => ['member', 'formerMember'],
    ],

    'events.publish' => [
        'committee' => [
            'webcie',
            'prescie'
        ],
        'senate' => true
    ],

    'senates.manage' => [
        'committee' => ['webcie'],
        'senate' => true
    ],

    'admin' => [
        'committee' => [
            'webcie'
        ]
    ],

    'users.show' => [
        'type' => ['member', 'formerMember']
    ],

    'users.edit-profile' => [
        'type' => ['potential', 'member', 'formerMember']
    ],

    'threads.show-private' => [
        'type' => ['member', 'formerMember']
    ],

    'threads.manage' => [
        'committee' => [
            'webcie'
        ]
    ]
];