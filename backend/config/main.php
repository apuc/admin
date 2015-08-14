<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'header' => [
            'class' => 'backend\modules\header\Header',
        ],
        'footer' => [
            'class' => 'backend\modules\footer\Footer',
        ],
        'material' => [
            'class' => 'backend\modules\material\Material',
        ],
        'color' => [
            'class' => 'backend\modules\color\Color',
        ],
        'block' => [
            'class' => 'backend\modules\block\Block',
        ],
    ],
    'components' => [
        'request'      => [
            'baseUrl' => '/secure',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                'header' => 'header/header',
                'footer' => 'footer/footer',
                'material' => 'material/material',
                'color' => 'color/color'
            ],
        ],
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
