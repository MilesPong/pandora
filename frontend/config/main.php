<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
            'user' => [
                    // following line will restrict access to admin page
                    'as frontend' => 'dektrium\user\filters\FrontendFilter'
            ]
    ],
    'components' => [
        'user' => [
//             'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [ 
                    'name' => '_frontendIdentity',
                    'path' => '/',
                    'httpOnly' => true 
            ],
        ],
//         'urlManager' => [
//                 'enablePrettyUrl' => true,
//                 'showScriptName' => false,
//                 'class' => 'yii\web\UrlManager',
//         ],
        'urlManagerBackend' => [
                // here is your Back-end URL rules
                'class' => 'yii\web\urlManager',
                'baseUrl' => 'Your Backend URL', // Your Backend URL,e.g: '//backend.dev'
                'enablePrettyUrl' => true,
                'showScriptName' => false 
        ],
        'session' => [ 
                'name' => 'FRONTENDSESSID',
                'cookieParams' => [ 
                        'httpOnly' => true,
                        'path' => '/' 
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
