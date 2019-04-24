<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . getenv('DB_HOST', 'mysql') . ';port=' . getenv('DB_PORT', '3306') .';dbname=' . getenv('DB_NAME', 'yii2') . ';',
    'username' => getenv('DB_USERNAME', 'yii2'),
    'password' => getenv('DB_PASSWORD', 'yii2'),
    'charset' => 'utf8',
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
