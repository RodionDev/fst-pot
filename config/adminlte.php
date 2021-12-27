<?php
return [
    'title' => env('APP_NAME'),
    'title_prefix' => '',
    'title_postfix' => ' — ' . env('APP_NAME'),
    'logo' => '<b>'.env('APP_NAME').'</b>',
    'logo_mini' => '<small>'.env('APP_NAME').'</small>',
    'skin' => 'black',
    'layout' => null,
    'collapse_sidebar' => false,
    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'menu' => [
        [
            'text' => 'Frontend',
            'url' => '/',
            'icon' => 'fas fa-fw fa-arrow-left',
        ],
        ['header' => 'Hauptmenü'],
        [
            'text' => 'Dashboard',
            'url' => 'dashboard',
            'icon' => 'fas fa-fw fa-thumbtack',
        ],
        [
            'text' => 'Devices',
            'icon' => 'fas fa-fw fa-desktop',
            'can'  => 'manage-signage',
            'submenu' => [
                [
                    'text' => 'Geräteliste',
                    'url' => 'devices',
                    'icon' => 'fas fa-fw fa-clipboard-list',
                    'active' => ['devices', 'devices/?page=*'],
                ],
                [
                    'text' => 'Neues Gerät',
                    'url' => 'devices/create',
                    'icon' => 'fas fa-fw fa-plus-square',
                    'active' => ['devices/create'],
                ],
            ],
        ],
        [
            'text' => 'Channels',
            'icon' => 'fas fa-fw fa-project-diagram',
            'can'  => 'manage-signage',
            'submenu' => [
                [
                    'text' => 'Channelliste',
                    'url' => 'channels',
                    'icon' => 'fas fa-fw fa-clipboard-list',
                    'active' => ['channels', 'channels/?page=*'],
                ],
                [
                    'text' => 'Neuer Channel',
                    'url' => 'channels/create',
                    'icon' => 'fas fa-fw fa-plus-square',
                    'active' => ['channels/create'],
                ],
            ],
        ],
        [
            'header' => 'Administration',
            'can'  => 'view-admin-menu',
        ],
        [
        'text' => 'Logs',
        'url' => '/logs',
        'target' => '_blank',
        'icon' => 'fas fa-fw fa-scroll',
        'can'  => 'manage-vspot',
        ],
        [
            'text'    => 'Benutzerverwaltung',
            'icon'    => 'fas fa-fw fa-users',
            'can'  => 'manage-users',
            'submenu' => [
                [
                    'text' => 'Benutzerliste',
                    'url' => 'admin/users',
                    'icon' => 'fas fa-fw fa-user-check',
                    'active' => ['admin/users', 'admin/users/?page=*'],
                ],
                [
                    'text' => 'Registrierungen',
                    'url' => 'admin/registrations',
                    'icon' => 'fas fa-fw fa-user-times',
                    'active' => ['admin/registrations', 'admin/registrations/?page=*'],
                ],
            ],
        ],
    ],
    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],
    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '
                ],
            ],
        ],
        [
            'name' => 'Pace',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '
                ],
            ],
        ],
        [
            'name' => 'FontAwesome',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '
                ]
            ],
        ],
    ],
];
