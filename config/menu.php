<?php
//Max depth = 3 (Dasboard -> depth 1 -> depth 2 -> depth 3)
return [
    'Safe bot' => [
        'children' => [
            'Scams' => [
                'icon' => 'fas fa-triangle-exclamation',
                'can' => ['scam.index'],
                'route' => 'scam.index',
            ],
            'Subscribers' => [
                'icon' => 'fas fa-users',
                'can' => ['subscribers.index'],
                'route' => 'subscriber.index',
            ],
            'Discord webhooks' => [
                'icon' => 'fas fa-link',
                'can' => ['webhook.index'],
                'route' => 'webhook.index',
            ],
        ],
    ],
    'User' => [
        'children' => [
            'Users' => [
                'icon' => 'fas fa-user',
                'children' => [
                    'All Users' => [
                        'can' => ['users.index'],
                        'route' => 'users.index',
                    ],
                    'Roles' => [
                        'can' => ['roles.index'],
                        'route' => 'roles.index',
                    ],
                ]
            ],
        ],
    ],
    'Platform' => [
        'children' => [
            'Settings' => [
                'icon' => 'fas fa-gear',
                'children' => [
                    'Colors' => [
                        'can' => ['color.index'],
                        'route' => 'color.index',
                    ],
                    'Discord bot' => [
                        'children' => [
                            'Scams statuses' => [
                                'can' => ['scam-status.index'],
                                'route' => 'scam-status.index',
                            ],
                            'Scams categories' => [
                                'can' => ['scam-category.index'],
                                'route' => 'scam-category.index',
                            ],
                            'API docs' => [
                                'can' => ['api.index'],
                                'route' => 'l5-swagger.default.api',
                            ],
                        ]
                    ],
                ]
            ],
        ],
    ],
];
