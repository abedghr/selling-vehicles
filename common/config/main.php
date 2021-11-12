<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\redis\Cache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => 'qwer1234',  //typically a long random string
            'jwtValidationData' => \common\modules\Jwt\JwtValidationData::class,
        ],
    ],
];
