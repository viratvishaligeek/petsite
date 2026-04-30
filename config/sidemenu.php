<?php

return [

    // dashboard menu
    [
        'title' => 'Dashboard',
        'icon' => 'fa-solid fa-gauge',
        'route' => 'admin.dashboard',
        'active' => 'admin.dashboard',
        'can' => [],
    ],

    // advance module menu
    [
        'title' => 'Advance Module',
        'icon' => 'fa-solid fa-layer-group',
        'can' => ['team-browse', 'role-browse'],
        'children' => [
            [
                'name' => 'Team Members',
                'icon' => 'fa-solid fa-users',
                'route' => 'admin.team.index',
                'active' => 'admin.team.*',
                'can' => ['team-browse'],
            ],
            [
                'name' => 'Roles & Permissions',
                'icon' => 'fa-solid fa-shield-halved',
                'route' => 'admin.role.index',
                'active' => 'admin.role.*',
                'can' => ['role-browse'],
            ],
        ],
    ],

    // blogging module menu
    [
        'title' => 'Blogging',
        'icon' => 'fa-solid fa-blog',
        'can' => ['blog_category-browse', 'blog-browse'],
        'children' => [
            [
                'name' => 'Catgeory',
                'route' => 'admin.blog-category.index',
                'active' => 'admin.blog-category.*',
                'can' => ['blog_category-browse'],
            ],
            [
                'name' => 'Post',
                'route' => 'admin.blog.index',
                'active' => 'admin.blog.*',
                'can' => ['blog-browse'],
            ],
        ],
    ],

    // product module menu
    [
        'title' => 'Products',
        'icon' => 'fa-solid fa-box-open',
        'can' => ['brand-browse', 'category-browse', 'options-browse', 'option_value-browse', 'product-browse'],
        'children' => [
            [
                'name' => 'Brands',
                'route' => 'admin.brand.index',
                'active' => 'admin.brand.*',
                'can' => ['brand-browse'],
            ],
            [
                'name' => 'Category',
                'route' => 'admin.category.index',
                'active' => 'admin.category.*',
                'can' => ['category-browse'],
            ],
            [
                'name' => 'Product Option',
                'route' => 'admin.options.index',
                'active' => 'admin.options.*',
                'can' => ['options-browse'],
            ],
            [
                'name' => 'Option Value',
                'route' => 'admin.option-value.index',
                'active' => 'admin.option-value.*',
                'can' => ['option_value-browse'],
            ],
            [
                'name' => 'Products',
                'route' => 'admin.product.index',
                'active' => 'admin.product.*',
                'can' => ['product-browse'],
            ],
            [
                'name' => 'Low Stock Products',
                'route' => 'admin.option-value.index',
                'active' => 'admin.option-value.*',
                'can' => [],
            ],
        ],
    ],

    // setting module menu
    [
        'title' => 'Setting',
        'icon' => 'fa-solid fa-gear',
        'can' => ['global-setting', 'general-setting', 'seo-setting', 'email-setting'],

        'children' => [
            [
                'name' => 'Global',
                'route' => 'admin.setting.edit',
                'active' => 'admin.setting.edit',
                'params' => 'global',
                'can' => ['global-setting'],
            ],
            [
                'name' => 'General',
                'route' => 'admin.setting.edit',
                'active' => 'admin.setting.edit',
                'params' => 'general',
                'can' => ['general-setting'],
            ],
            [
                'name' => 'Email',
                'route' => 'admin.setting.edit',
                'active' => 'admin.setting.edit',
                'params' => 'email',
                'can' => ['email-setting'],
            ],
        ],
    ],

    // Global SEO Config menu
    [
        'title' => 'All Seo Config',
        'icon' => 'fa-solid fa-rss',
        'can' => ['seo-setting'],

        'children' => [
            [
                'name' => 'Brand',
                'route' => 'admin.seo-plugin.index',
                'active' => 'admin.seo-plugin.index',
                'params' => 'brand',
                'can' => [],
            ],
            [
                'name' => 'Categories',
                'route' => 'admin.seo-plugin.index',
                'active' => 'admin.seo-plugin.index',
                'params' => 'category',
                'can' => [],
            ],
            [
                'name' => 'Product',
                'route' => 'admin.seo-plugin.index',
                'active' => 'admin.seo-plugin.index',
                'params' => 'product',
                'can' => [],
            ],
            [
                'name' => 'Blog Categories',
                'route' => 'admin.seo-plugin.index',
                'active' => 'admin.seo-plugin.index',
                'params' => 'blogcategory',
                'can' => [],
            ],
            [
                'name' => 'Blogs',
                'route' => 'admin.seo-plugin.index',
                'active' => 'admin.seo-plugin.index',
                'params' => 'blog',
                'can' => [],
            ],
        ],
    ],

    // file manager menu
    [
        'title' => 'File Manager',
        'icon' => 'fa-solid fa-images',
        'route' => 'admin.laravel-filemanager',
        'active' => 'admin.laravel-filemanager',
        'can' => [],
    ],

    // logout menu
    [
        'title' => 'Logout',
        'icon' => 'fa-solid fa-sign-out',
        'route' => 'admin.logout',
        'can' => [],
    ],
];