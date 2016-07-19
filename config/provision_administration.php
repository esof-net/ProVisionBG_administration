<?php

return [

    'version' => '0.0.1',
    //@todo: да го махна от тук!

    /*
     * Адрес към администрацията
     */
    'url_prefix' => 'admin',

    /*
     * префикс за командите с artisan
     */
    'command_prefix' => 'admin',

    /*
     * Settings controller
     */
    'settings_controller' => '\ProVision\Administration\Http\Controllers\SettingsController',

    /*
     * Image sizes
     *
     * 'key' =>[
     *     'mode' => 'resize | fit', //required - http://image.intervention.io/api/resize - http://image.intervention.io/api/fit
     *     'width' => 100,
     *     'height' => 100,
     *     'aspectRatio' => true,
     *     'upsize' => true
     * ]
     */
    'image_sizes' => [
        'A' => [
            'mode' => 'resize',
            'width' => 200,
            'height' => 200
        ]
    ]
];