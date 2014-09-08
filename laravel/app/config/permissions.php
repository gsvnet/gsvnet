<?php
use GSVnet\Users\User as User;

/**
*
*   Permission configuration
*   Permissions are configured such that if a user has one of the
*    then the user has the permission
*/
return [
    'member-or-former-member' => [
        'type' => [User::MEMBER, User::FORMERMEMBER]
    ],

    'user.become-member' => [
        'type' => ['visitor']
    ],

    'users.manage' => [
        'committee' => ['webcie', 'novcie'],
        'senate' => true
    ],

    'committees.manage' => [
        'type' => [User::MEMBER, User::FORMERMEMBER]
        //'committee' => ['webcie'],
        //'senate' => true
    ],

    'committees.show-novcie' => [
        'type' => [User::MEMBER, User::FORMERMEMBER]
    ],

    'photos.show-private' => [
        'type' => [User::MEMBER, User::FORMERMEMBER]
    ],

    'photos.manage' => [
        'committee' => [
            'webcie',
            'reebocie',
            'prescie'
        ]
    ],

    'docs.show' => [
        'type' => [User::MEMBER, User::FORMERMEMBER]
    ],

    'docs.manage' => [
        'type' => [User::MEMBER, User::FORMERMEMBER]
    ],

    'docs.publish' => [
        'committee' => [
            'webcie'
        ],
        'senate' => true
    ],

    'events.show-private' => [
        'type' => [User::MEMBER, User::FORMERMEMBER],
    ],

    'events.manage' => [
        'type' => [User::MEMBER, User::FORMERMEMBER],
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
        'type' => [User::MEMBER, User::FORMERMEMBER]
    ],

    'users.edit-profile' => [
        'type' => ['potential', User::MEMBER, User::FORMERMEMBER]
    ],

    'threads.show-private' => [
        'type' => [User::MEMBER, User::FORMERMEMBER]
    ],

    'threads.manage' => [
        'committee' => [
            'webcie'
        ]
    ]
];