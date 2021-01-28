<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'Kontrak',
        ],
        [
            'title' => 'Kelola Kontrak',
            'root' => true,
            'icon' => 'media/svg/icons/Files/File.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'Kontrak',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'Barang',
        ],
        [
            'title' => 'Kelola Barang',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/Bag2.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'Barang',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'Pengiriman',
        ],
        [
            'title' => 'Pengiriman Barang',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/Box1.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'Pengiriman',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'Account',
        ],
        [
            'title' => 'Account',
            'root' => true,
            'icon' => 'media/svg/icons/Files/User-folder.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'Account',
            'new-tab' => false,
        ],
        [
            'title' => 'Logout',
            'root' => true,
            'icon' => 'media/svg/icons/Tools/Angle Grinder.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'Auth/Logout',
            'new-tab' => false,
        ],
    ]
];
