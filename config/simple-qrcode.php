<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | QR Code Defaults
    |--------------------------------------------------------------------------
    |
    | This option configures the default QR code settings that are used when 
    | generating QR codes through the Laravel Simple QR Code package.
    | Setting driver to 'svg' removes the need for Imagick/GD.
    |
    */
    
    'default' => 'svg',
    
    'drivers' => [
        'png' => [
            'driver' => 'png',
            'libOptions' => [],
        ],
        'svg' => [
            'driver' => 'svg',
            'libOptions' => [],
        ],
    ],
    
];