<?php use GSVnet\Users\User as User;

/**
 * Permission configuration
 * Permissions are configured such that if a user has one of the
 * then the user has the permission
 */
return [
    /**
     * General permissions don't require checks with respect to the specific entity
     * For instance: permission to manage committees or photos
     */
    'general' => [
        'ads.hide' => [
            'type' => [User::MEMBER, User::FORMERMEMBER]
        ],

        'member-or-former-member' => [
            'type' => [User::MEMBER, User::FORMERMEMBER]
        ],

        'user.become-member' => [
            'type' => [User::VISITOR]
        ],

        'users.show' => [
            'type' => [User::MEMBER, User::FORMERMEMBER],
        ],

        'users.manage' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],

        'committees.manage' => [
            'committee' => ['webcie'],
            'senate' => true
        ],

        'committees.show-novcie' => [
            'type' => [User::MEMBER, User::FORMERMEMBER]
        ],

        'photos.show-private' => [
            'type' => [User::MEMBER, User::FORMERMEMBER]
        ],

        'photos.manage' => [
            'committee' => ['webcie', 'reebocie', 'prescie'],
            'senate' => true
        ],

        'docs.show' => [
            'type' => [User::MEMBER, User::FORMERMEMBER]
        ],

        'docs.manage' => [
            'type' => [User::MEMBER, User::FORMERMEMBER]
        ],

        'docs.publish' => [
            'committee' => ['webcie'],
            'senate' => true
        ],

        'events.show-private' => [
            'type' => [User::MEMBER, User::FORMERMEMBER],
        ],

        'events.manage' => [
            'type' => [User::MEMBER, User::FORMERMEMBER],
        ],

        'events.publish' => [
            'committee' => ['webcie', 'prescie'],
            'senate' => true
        ],

        'senates.manage' => [
            'committee' => ['webcie'],
            'senate' => true
        ],

        'admin' => [
            'committee' => ['webcie']
        ],

        'users.edit-profile' => [
            'type' => ['potential', User::MEMBER, User::FORMERMEMBER, User::INTERNAL_COMMITTEE]
        ],

        'threads.show-private' => [
            'type' => [User::MEMBER, User::FORMERMEMBER, User::INTERNAL_COMMITTEE]
        ]
    ],

    /**
     * Entity specific permissions are derived from the entity: for instance, a user
     * can change his own profile, but not someone else's. Or one cannot like his or her
     * own forum topic or reply. The exact restrictions are set in \GSV\Providers\AuthServiceProvider
     */
    'entity-specific' => [
        'thread.manage' => [
            'committee' => ['webcie'],
            'senate' => true
        ],

        'thread.like' => [],

        'reply.manage' => [
            'committee' => ['webcie'],
            'senate' => true
        ],

        'reply.like' => [],

        'user.manage.address' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.birthday' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.business' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.email' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.gender' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.name' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.parents' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.password' => [
            'committee' => ['webcie', 'novcie', 'malversacie'],
            'senate' => true
        ],
        'user.manage.phone' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.photo' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.year' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'formerMember.manage.year' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.study' => [
            'committee' => ['webcie', 'novcie', 'malversacie', 'jaarbundelcommissie'],
            'senate' => true
        ],
        'user.manage.receive_newspaper' => [
            'committee' => ['webcie', 'malversacie'],
            'senate' => true
        ]
    ],
];