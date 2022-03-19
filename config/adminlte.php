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
            'icon' => 'fas fa-fw fa-globe',
        ],
        ['header' => 'Hauptmenü'],
        [
            'text' => 'Dashboard',
            'url' => 'dashboard',
            'icon' => 'fas fa-fw fa-th',
        ],
        [
            'text' => 'Devices',
            'icon' => 'fas fa-fw fa-desktop',
            'can'  => 'manage-signage',
            'submenu' => [
                [
                    'text' => 'Geräteliste',
                    'url' => 'devices',
                    'icon' => 'fas fa-fw fa-list-alt',
                    'active' => ['devices', 'devices/?page=*', 'devicesscreens', 'channelsscreens
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
        [
            'name' => 'bootstrap-colorpicker',
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
            'name' => 'summernote',
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
    ],
];
