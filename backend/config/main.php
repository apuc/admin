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
        'media' => [
            'class' => 'backend\modules\media\Media',
        ],
        'menu' => [
            'class' => 'backend\modules\menu\Menu',
        ],
        'category' => [
            'class' => 'backend\modules\category\Category',
        ],
        'pages' => [
            'class' => 'backend\modules\pages\Pages',
        ],
        'options' => [
            'class' => 'backend\modules\options\Options',
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
                'block' => 'block/block',
                'color' => 'color/color',
                'block/add_img' => 'block/block/add_img',
                'media' => 'media/media',
                'media/delete' => 'media/media/delete',
                'menu' => 'menu/menu',
                'update_el' => 'menu/menu/update_el',
                'category' => 'category/category',
                'pages' => 'pages/pages'
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
