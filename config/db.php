<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . env('DB_HOST', 'mysql') . ';port=' . env('DB_PORT', '3306') .';dbname=' . env('DB_NAME', 'yii2') . ';',
    'username' => env('DB_USERNAME', 'yii2'),
    'password' => env('DB_PASSWORD', 'yii2'),
    'charset' => 'utf8',
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
