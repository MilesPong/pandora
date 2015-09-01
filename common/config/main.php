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
    ],
];
