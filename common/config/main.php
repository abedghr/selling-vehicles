<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ar',
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
        'db' => [
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 21600, // 6 hours
            'schemaCache' => 'cache',
            'enableQueryCache' => true,
            'queryCacheDuration' => 1800, // 30 minutes
        ],
    ],
];
