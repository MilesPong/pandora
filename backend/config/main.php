<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
    		// Configuration Yii2-User Backend //
    		'user' => [
    				//following line will restrict access to admin page
//     				'as backend' => 'dektrium\user\filters\BackendFilter',
//     				'class' => 'dektrium\user\Module',
    				'controllerMap' => [
    						'security' => 'backend\controllers\SecurityController'
    				],
    				'enableRegistration' => false,
    				'enableConfirmation' => false,
    				'enablePasswordRecovery' => false,
    		],
    		'utility' => [
    				'class' => 'c006\utility\migration\Module',
    		],
    		'admin' => [
    				'class' => 'mdm\admin\Module',
    				'controllerMap' => [
    						'assignment' => [
    								'class' => 'mdm\admin\controllers\AssignmentController',
    								/* 'userClassName' => 'app\models\User', */ // fully qualified class name of your User model
    								// Usually you don't need to specify it explicitly, since the module will detect it automatically
    								'idField' => 'id',        // id field of your User model that corresponds to Yii::$app->user->id
    								'usernameField' => 'username', // username field of your User model
    								//'searchClass' => 'app\models\UserSearch'    // fully qualified class name of your User model for searching
    						]
    				],
    				'layout' => 'top-menu',
    				'menus' => [
    						'assignment' => [
    								'label' => 'Grant Access' // change label
    						],
//     						'route' => null, // disable menu
    				],
    		]
    ],
    'components' => [
        'user' => [
//             'identityClass' => 'common\models\User',
//         		'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
			'identityCookie' => [ 
					'name' => '_backendIdentity',
					'path' => '/',
					'httpOnly' => true 
			],
        ],    		
		'session' => [ 
				'name' => 'BACKENDSESSID',
				'cookieParams' => [ 
						'httpOnly' => true,
						'path' => '/' 
				] 
		],
		'view' => [ 
				'theme' => [ 
						'pathMap' => [ 
								'@dektrium/user/views' => '@backend/views/user' 
						] 
				] 
		],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
