<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
date_default_timezone_set('Asia/Jakarta'); 
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SIP-POS',

	// preloading 'log' component
	'preload'=>array('log'),
	'aliases' => array(
		'RestfullYii' =>realpath(__DIR__ . '/../extensions/starship/RestfullYii'),
	),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),	
	
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'tapcash', 
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array(
			'127.0.0.1',
			'36.81.0.29',
			'36.78.42.122',
			'192.168.1.87',
			'::1'),
			'generatorPaths'=>array(
				'bootstrap.gii',
			),
		),
		
	),

	'defaultController'=>'home',

	// application components
	'components'=>array(
		'encrypter'=>array (
			'class'=>'ext.encrypter.Encrypter',
			'key'=>'12345',
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),*/
		// uncomment the following to use a MySQL database
	
		'db'=>array(
			'connectionString' => 'pgsql:host=localhost;port=8382;dbname=pro6',
			'emulatePrepare' => true,
			'username' => 'postgres',
			'password' => 'bajahitam',
			'charset' => 'utf8',
		),	 
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'home/error',
		),
		
		'urlManager'=>array(
			'showScriptName'=>false,
			'caseSensitive'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				dirname(__FILE__).'/../extensions/starship/restfullyii/config/routes.php',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				 // REST patterns
				array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
				array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
				array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
				array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
				array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
			),
			'showScriptName'=>true,
			'urlSuffix'=>'.html',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),/*
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		),*/
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	//'params'=>require(dirname(__FILE__).'/params.php'),
	'params'=>array(
		'adminEmail'=>'webmaster@example.com',
	),
);
