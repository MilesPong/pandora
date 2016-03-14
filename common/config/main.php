<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//     'language' => 'zh-CN', // 启用国际化支持
//     'sourceLanguage' => 'zh-CN', // 源代码采用中文
//     'timeZone' => 'Asia/Shanghai', // 设置时区
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
//             'class' => 'yii\caching\MemCache',
//             'servers' => [
//                 [
//                     'host' => '127.0.0.1',
//                     'port' => 11211,
//                     'weight' => 60,
//                 ],
//             ],
//             'useMemcached' => true,
        ],
        'formatter' => [ 
                'class' => 'yii\i18n\Formatter',
                'dateFormat' => 'yyyy-MM-dd',
                'datetimeFormat' => 'php:Y-m-d H:i:s',
                'defaultTimeZone' => 'Asia/Shanghai',
                'timeFormat' => 'php:H:i:s',
                'decimalSeparator' => ',',
                'thousandSeparator' => ' ',
                'currencyCode' => 'CNY' 
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // Deault role for guest, you must add `guest` role
            // and proper permissions or routes for unregisters(vistors).
            // E.g. `site/*`, `user\login`, etc
            'defaultRoles' => ['guest'],
        ],
        'urlManager' => [ 
                // here is your URL rules
                'enablePrettyUrl' => true,
                'showScriptName' => false,
//                 'baseUrl' => $_SERVER['HTTP_HOST'],
//                 'suffix'=>'.html',
                // 'enableStrictParsing' => false,
//                 'rules' => [
//                     'userinfos' => 'user-info/index',
//                     'user-info/view/<id:\d+>' => 'user-info/view'
//                 ]
        ],
        'mapList' => [
            'class' => 'common\components\MapList'
        ]
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            // Users who have admin right to access the admin panel of user/admin.
            // Plaease note that RBAC is not functioned with this `user/admin` action,
            // you must specify set the admin to give the control right.
            // It's suggested to set the value in the main-local.php
            'admins' => ['admin','miles']
            // you will configure your module inside this file
            // or if need different configuration for frontend and backend you may
            // configure in needed configs
        ]
    ],
    // The actions listed here will be allowed to everyone including guests.
    // So, 'admin/*' should not appear here in the production, of course.
    // But in the earlier stages of your development, you may probably want to
    // add a lot of actions here until you finally completed setting up rbac,
    // otherwise you may not even take a first step.
    'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                    //'admin/*',
                    //'some-controller/some-action',
                    // Uncomment the next line if you are in the very start deployment and still not set the RBAC yet.
                    //'*',
            ]
    ],
];
