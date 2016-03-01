<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
// 	'language' => 'zh-CN', // 启用国际化支持
// 	'sourceLanguage' => 'zh-CN', // 源代码采用中文
// 	'timeZone' => 'Asia/Shanghai', // 设置时区
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
    	],
		'urlManager' => [ 
				// here is your URL rules
				'enablePrettyUrl' => true,
				'showScriptName' => false,
// 				'baseUrl' => $_SERVER['HTTP_HOST'],
// 				'suffix'=>'.html',
				// 'enableStrictParsing' => false,
// 				'rules' => [
// 				    'userinfos' => 'user-info/index',
// 				    'user-info/view/<id:\d+>' => 'user-info/view'
// 				]
		],
    ],
	'modules' => [
			'user' => [
					'class' => 'dektrium\user\Module',
					'admins' => ['admin', 'miles'],					
					// you will configure your module inside this file
					// or if need different configuration for frontend and backend you may
					// configure in needed configs
			],
	],
	/* 'as access' => [
			'class' => 'mdm\admin\components\AccessControl',
			'allowActions' => [
					'user/*',
					'site/*',
					'admin/*',
					//'some-controller/some-action',
					// The actions listed here will be allowed to everyone including guests.
					// So, 'admin/*' should not appear here in the production, of course.
					// But in the earlier stages of your development, you may probably want to
					// add a lot of actions here until you finally completed setting up rbac,
					// otherwise you may not even take a first step.
			]
	], */
];
