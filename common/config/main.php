<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
// 	'language' => 'zh-CN', // 启用国际化支持
// 	'sourceLanguage' => 'zh-CN', // 源代码采用中文
	'timeZone' => 'Asia/Shanghai', // 设置时区
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'formatter' => [ 
				'class' => 'yii\i18n\Formatter',
				'dateFormat' => 'yyyy-MM-dd',
				'datetimeFormat' => 'php:Y-m-d H:i:s',
				'timeFormat' => 'php:H:i:s',
				'decimalSeparator' => ',',
				'thousandSeparator' => ' ',
				'currencyCode' => 'CNY' 
		],
		'urlManager' => [ 
				// here is your backend URL rules
				'enablePrettyUrl' => true,
				'showScriptName' => false,
// 				'suffix'=>'.html',
				// 'enableStrictParsing' => false,
		],
// 		'urlManagerFrontend' => [ 
// 				// here is your Front-end URL rules
// 				'class' => 'yii\web\urlManager',
// 				'baseUrl' => '/a/frontend/web',
// 				'enablePrettyUrl' => true,
// 				'showScriptName' => false,
// // 				'enableStrictParsing' => true,
// 		],
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
];
