<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout'=>'main',
            // 'layout'=>'admin',
            // 'layoutPath'=>'@app/themes/adminLTE/layouts',
        ],
        'components' => [
            'view' => [
                'theme' => [
                    'pathMap' => [
                        '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                    ],
                ],
            ],
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],

//        'datecontrol' =>  [
//            'class' => 'kartik\datecontrol\Module',
//
//            // format settings for displaying each date attribute
//            'displaySettings' => [
//                'date' => 'd-m-Y',
//                'time' => 'H:i:s A',
//                'datetime' => 'd-m-Y H:i:s A',
//            ],
//
//            // format settings for saving each date attribute
//            'saveSettings' => [
//                'date' => 'Y-m-d',
//                'time' => 'H:i:s',
//                'datetime' => 'Y-m-d H:i:s',
//            ],
//
//            // automatically use kartik\widgets for each of the above formats
//            'autoWidget' => false,
//
//        ],
        ],
    'controllerMap' => [
//        'elfinder' => [
//            'class' => 'mihaildev\elfinder\PathController',
//            'access' => ['@'],
//            'root' => [
//                'baseUrl'=>'/web',
//                // 'basePath'=>'@webroot',
//                'path' => 'files',
//                'name' => 'Files',
//                'options' => ['encoding' => 'UTF-8']
//
//            ],
////            'watermark' => [
////                'source'         => __DIR__.'/logo.png', // Path to Water mark image
////                'marginRight'    => 5,          // Margin right pixel
////                'marginBottom'   => 5,          // Margin bottom pixel
////                'quality'        => 95,         // JPEG image save quality
////                'transparency'   => 70,         // Water mark image transparency ( other than PNG )
////                'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
////                'targetMinPixel' => 200         // Target image minimum pixel size
////            ]
//        ]

        'elfinder' => [
            'class' => '\mihaildev\elfinder\PathController',



            'connectOptions' => [
                'bind' => array(
                    'mkdir.pre mkfile.pre rename.pre archive.pre' => array(
                        'Plugin.Sluggable.cmdPreprocess'
                    ),
                    'upload.presave' => array(
                        'Plugin.Sluggable.onUpLoadPreSave'
                    )
                ),
                'plugin' => [
                    'Sluggable' => [
                        'enable' => true,
                        'lowercase' => false,
                        'replacement' => '-'

                    ],
                ],
            ],
            'root' => [
                                'baseUrl'=>'/web',
                // 'basePath'=>'@webroot',
                'path' => 'files',
                'name' => 'Files',


//                'baseUrl' => '@web/files/global',
//                'basePath' => '@webroot/files/global',
                'access' => ['read' => '*', 'write' => '*'],
//                'name' => 'Name', // Yii::t($category, $message)


            ]
],

    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'f8gN3hjyddJUvmAYRk5gbl_0dGbRQUY2',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/login',
                '/index' => 'site/login',
//                '/admin' => 'site/login',
                'signup'=>'site/signup',
                'result'=>'site/result',
                'login' => 'site/login',
                'theory' => 'theory/index',
                'theory/<id:\d+>' => 'theory/view',
                'theory/<grf:\d+>/<id:\d+>' => 'theory/tasks',
                'training' => 'training/index',
                'training/<id:\d+>' => 'training/view',
                'training/<grf:\d+>/<id:\d+>' => 'training/tasks',
                'testing' => 'testing/index',
                'testing/<id:\d+>' => 'testing/view',
                'testing/<grf:\d+>/<id:\d+>' => 'testing/tasks',

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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
        'generators' => [ //here
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'adminlte' => '@vendor/dmstr/yii2-adminlte-asset/gii/templates/crud/simple',
                ]
            ],
//            'kartikgii-crud' => ['class' => 'warrence\kartikgii\crud\Generator'],
        ],
    ];
}

return $config;
