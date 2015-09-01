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
				'enablePrettyUrl' => true,
				'showScriptName' => false 
				// 'enableStrictParsing' => false,
		],
    ],
];
