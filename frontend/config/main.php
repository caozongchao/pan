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
                'site/index' => '',

                'c-<id:\d+>' => 'category/index',
                'c-<id:\d+>-<p:\d+>' => 'category/index',
                'c-<id:\d+>-<second:\w+>' => 'category/second',
                'c-<id:\d+>-<second:\w+>-<p:\d+>' => 'category/second',

                'd-<id:\d+>' => 'detail/index',

                'u-<id:\d+>' => 'user/index',
                'u-<id:\d+>-<p:\d+>' => 'user/index',

                's-<k:[^-]+>' => 'search/index',
                's-<k:[^-]+>-<p:\d+>' => 'search/index',
                'sd-<c:\d+>-<k:[^-]+>' => 'search/category',
                'sd-<c:\d+>-<k:[^-]+>-<p:\d+>' => 'search/category',
                'sds-<c:\d+>-<k:[^-]+>-<s:\w+>' => 'search/second',
                'sds-<c:\d+>-<k:[^-]+>-<s:\w+>-<p:\d+>' => 'search/second',

                't-<t:\d+>' => 'topic/index',
                't-<t:\d+>-<p:\d+>' => 'topic/index',
            ],
        ],
    ],
    'params' => $params,
];
