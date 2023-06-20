<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users'    => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'roles'            => 'c,r,u,d',
            'permissions'      => 'c,r,u,d',
            'sliders'          => 'c,r,u,d',
            'aqar_types'       => 'c,r,u,d',
            'services'         => 'c,r,u,d',
            'articles'         => 'c,r,u,d',
            'tags'             => 'c,r,u,d',
            'service_orders'   => 'c,r,u,d',
            'aqar_orders'      => 'c,r,u,d,a,rj',
            'orders'           => 'c,r,u,d',
            'report_questions' => 'c,r,u,d',
            'report_comments'  => 'c,r,u,d',
            'aqar_tips'        => 'c,r,u,d',
            'packages'         => 'c,r,u,d',
            'payment_methods'  => 'c,r,u,d',
            'aqar_features'    => 'c,r,u,d',
            'cities'           => 'c,r,u,d',
            'regions'          => 'c,r,u,d',
            'admins'           => 'c,r,u,d',
            'users'            => 'c,r,u,d',
            'settings'         => 'c,r,u,d'
        ],
        'admin'       => [],
        'user'        => []
    ],

    'permissions_map' => [
        'c'  => 'create',
        'r'  => 'read',
        'u'  => 'update',
        'd'  => 'delete',
        'a'  => 'accept',
        'rj' => 'reject',
    ]
];
