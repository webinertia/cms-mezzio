<?php

declare(strict_types=1);

return [
    'mezzio-authorization-acl' => [
        'roles'     => [
            'Administrator' => ['manager'],
            'manager'       => ['supervisor'],
            'supervisor'    => ['employee'],
            'employee'      => ['staff'],
            'staff'         => ['customer'],
            'customer'      => ['member'],
            'member'        => ['guest'],
            'guest'         => [],
        ],
        'resources' => [
            'user.login',
            'user.logout',
            'page',
            'home',
        ],
        'allow'     => [
            'member' => [
                'user.logout',
            ],
            'guest'  => [
                'user.login',
                'page',
                'home',
            ],
        ],
        'deny'      => [
            'member' => ['user.login'],
            'guest'  => ['user.logout'],
        ],
    ],
];
