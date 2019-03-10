<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'cheatera.pp.ua',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'sourceLanguage' => 'en', // использовать в качестве ключей переводов
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
   'modules' => [
        'languages' => [
            'class' => 'klisl\languages\Module',
        //Языки используемые в приложении
            'languages' => [
                'Русский' => 'ru',
                'Українська' => 'uk',
                'English' => 'en',
            ],
            'default_language' => 'en', //основной язык (по-умолчанию)
            'show_default' => false, //true - показывать в URL основной язык, false - нет
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => env('VD_KEY', ''),
            'baseUrl' => '', //убрать frontend/web
            'class' => 'klisl\languages\Request',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/auth?authclient=auth42']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'auth42' => [
                    'class' => 'app\helpers\Auth42',
                    'clientId' => env('42_API_CI', ''),
                    'clientSecret' => env('42_API_CS', ''),
                ],
                // etc.
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'class' => 'klisl\languages\UrlManager',
            'rules' => [
                'languages' => 'languages/default/index', //для модуля мультиязычности
                //далее создаем обычные правила
                '/' => 'site/index',
                '<action:(captcha|welcome|login|auth|contact|logout|language|about)>' => 'site/<action>',
                'students/projects/<id:[\w\-]+>' => 'projects/students-view',
                'pools/projects/<id:[\w\-]+>' => 'projects/pools-view',
                'students/projects' => 'projects/students',
                'pools/projects' => 'projects/pools',
                'students/cheating' => 'minus42/students',
                'pools/cheating' => 'minus42/pools',
                'students/<id:\w+>' => 'show/students-view',
                'pools/<id:\w+>' => 'show/pools-view',
                'students' => 'show/students',
                'pools' => 'show/pools',
                'calculator' => 'calculator',
                'corrections' => 'corrections/index',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['172.*.*.*', '192.168.99.1', '127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['172.*.*.*', '192.168.99.1', '127.0.0.1', '::1'],
    ];
}

return $config;
