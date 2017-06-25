<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD,
                    ]
                ],
                // 'yii\bootstrap\BootstrapAsset' => [
                //     'css' => []
                // ],
                // 'yii\bootstrap\BootstrapPluginAsset' => [
                //     'js'=>[]
                // ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'index.php' => '',

                'c-<id:\d+>' => 'category/index',
                'c-<id:\d+>-<page:\d+>' => 'category/index',
                'c-<id:\d+>-<second:\w+>' => 'category/second',
                'c-<id:\d+>-<second:\w+>-<page:\d+>' => 'category/second',

                'd-<id:\d+>' => 'detail/index',

                'u-<id:\d+>' => 'user/index',
                'u-<id:\d+>-<page:\d+>' => 'user/index',

                's-<k:\w+>' => 'search/index',
                's-<k:\w+>-<page:\d+>' => 'search/index',
                'sd-<category:\d+>-<k:\w+>' => 'search/category',
                'sd-<category:\d+>-<k:\w+>-<page:\d+>' => 'search/category',
                'sds-<category:\d+>-<k:\w+>-<second:\w+>' => 'search/second',
                'sds-<category:\d+>-<k:\w+>-<second:\w+>-<page:\d+>' => 'search/second',
            ],
        ],
    ],
    'params' => $params,
];
