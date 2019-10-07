<?php
// change the following paths if necessary
$yii    = dirname( __FILE__ ) . '/../yii/framework/yii.php';

// environment config file
$config = dirname( __FILE__ ) . '/protected/config/main.php';


// specify how many levels of call stack should be shown in each log message
defined( 'YII_TRACE_LEVEL' ) or define( 'YII_TRACE_LEVEL', 3 );

// show all errors
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );


require_once( $yii );
Yii::createWebApplication( $config )->run();
