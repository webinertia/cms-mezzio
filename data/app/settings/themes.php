<?php
return [
    'theme_manager' => [
        'themes' => [
            'default' => [
                'id' => 1,
                'active' => false,
                'name' => 'default',
                'fallback' => 'default',
                'resource_map' => [
                    'css/style.css'              => 'theme/default/css/style.css',
                    'css/bootstrap.css'          => 'theme/default/css/bootstrap.css',
                    'css/bootstrap.min.css'      => 'theme/default/css/bootstrap.min.css',
                    'js/bootstrap.js'            => 'theme/default/js/bootstrap.js',
                    'js/bootstrap.min.js'        => 'theme/default/js/bootstrap.min.js',
                    'img/favicon.ico'            => 'theme/default/img/favicon.ico',
                    'img/webinertia-logo-75.png' => 'theme/default/img/webinertia-logo-75.png',
                ],
            ],
            'dark' => [
                'id' => 2,
                'active' => false,
                'name' => 'dark',
                'fallback' => 'default',
            ],
            'jquery' => [
                'id' => 3,
                'active' => true,
                'name' => 'jquery',
                'fallback' => 'default',
            ],
        ],
    ],
];