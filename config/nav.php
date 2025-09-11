<?php

use Illuminate\Support\Facades\Route;

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'title' => 'Dashboard',
        'route' => 'dashboard.index',
    ],
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'title' => 'Categories',
        'route' => 'dashboard.categories.index',
        'active' => 'dashboard.categories.*',        #active param only for [[ group list ]] list have sublist

        'subList' => [
            [
                'title' => 'new Category',
                'route' => 'dashboard.categories.create',
            ],
            [
                'title' => 'show Categories',
                'route' => 'dashboard.categories.index',
            ]
        ]
    ],
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'title' => 'Products',
        'route' => 'dashboard.products.index',
        'active' => 'dashboard.products.*',

        'subList' => [
            [
                'title' => 'new Category',
                'route' => 'dashboard.products.create',
            ],
            [
                'title' => 'show Products',
                'route' => 'dashboard.products.index',
            ]
        ]
    ],
];
