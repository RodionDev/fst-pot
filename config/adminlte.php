<?php
return [
    'title' => env('APP_NAME'),
    'title_prefix' => '',
    'title_postfix' => ' — ' . env('APP_NAME'),
    'logo' => '<b>'.env('APP_NAME').'</b>',
    'logo_mini' => '<small>'.env('APP_NAME').'</small>',
    'skin' => 'black-light',
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
        ['header' => 'main_navigation'],
        [
            'text' => 'Dashboard',
            'url' => 'dashboard',
            'icon' => 'fas fa-fw fa-th',
        ],
        [
            'text' => 'Users',
            'url'  => 'admin/users',
            'icon' => 'fas fa-fw fa-users-cog',
        ],
        [
            'text' => 'Devices',
            'url'  => 'admin/devices',
            'icon'        => 'fas fa-fw fa-desktop',
        ],
        [
            'text' => 'Channels',
            'url'  => 'admin/channels',
            'icon'        => 'fas fa-fw fa-project-diagram',
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'Account',
            'url'  => 'admin/account',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => 'admin/password',
            'icon' => 'fas fa-fw fa-lock',
        ]
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
    ],
];
