<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
    'basePath'   => dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
    'name'       => 'CSV to JSON Converter',

    // preloading 'log' component
    'preload'    => [ 'log' ],

    // autoloading model and component classes
    'import'     => [
        'application.models.*',
        'application.components.*',
    ],
    'modules'    => [
        // uncomment the following to enable the Gii tool
        'gii'      => [
            'class'     => 'system.gii.GiiModule',
            'password'  => 'afd',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => [ '127.0.0.1', '::1' ],
        ],

    ],

    // application components
    'components' => [

        'urlManager' => require( dirname( __FILE__ ) . '/_urlmanager.php' ),

        // database settings are configured in database.php

        'errorHandler' => [
            // use 'site/error' action to display errors
            'errorAction' => YII_DEBUG ? null : 'site/error',
        ],

        'log' => [
            'class'  => 'CLogRouter',
            'routes' => [
                [
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',

                ],
                // uncomment the following to show log messages on web pages
                /*[
                    'class' => 'CWebLogRoute',
                ],*/

            ],
        ],

    ],

];
