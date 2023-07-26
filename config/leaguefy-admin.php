<?php

return [
    'route' => [
        'prefix' => '',
    ],
    'menu' => [
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text'        => 'games',
            'url'         => 'games',
            'icon'        => 'fas fa-fw fa-gamepad',
        ],
        [
            'text'        => 'teams',
            'url'         => 'teams',
            'icon'        => 'fas fa-fw fa-users',
        ],
        [
            'text'        => 'tournaments',
            'url'         => 'tournaments',
            'icon'        => 'fas fa-fw fa-trophy',
        ],
    ],
];
