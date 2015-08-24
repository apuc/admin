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
        'supplies' => [
            'class' => 'backend\modules\supplies\Supplies',
        ],
        'blind' => [
            'class' => 'backend\modules\blind\Blind',
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
                'pages' => 'pages/pages',
                'options' => 'options/options',
                'supplies' => 'supplies/supplies',
                'blind' => 'blind/blind',
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
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@', '?'],
//глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'disabledCommands' => ['netmount'],
//отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-con..
            'roots' => [
                [
                    'baseUrl' => '',
                    'basePath' => '@frontend/web',
                    'path' => 'image/upload',
                    'name' => 'Изображения',

//'uploadAllow' => ['image/png', 'image/jpeg', 'image/gif'],
                ],
// [
// 'class' => 'mihaildev\elfinder\UserPath',
// 'path' => 'files/user_{id}',
// 'name' => 'My Documents'
// ],
// [
// 'path' => 'image/some',
// 'name' => ['category' => 'my', 'message' => 'Some Name'] //перевод Yii::t($category, $message)
// ],
// [
// 'path' => 'image/some',
// 'name' => ['category' => 'my', 'message' => 'Some Name'], // Yii::t($category, $message)
// 'access' => ['read' => '*', 'write' => 'UserFilesAccess']
// // * - для всех, иначе проверка доступа в даааном примере все могут видет а редактировать могут пользователи только с правами UserFilesAccess
// ]
            ],
            'watermark' => [
                'source' => __DIR__ . '/logo.png', // Path to Water mark image
                'marginRight' => 5, // Margin right pixel
                'marginBottom' => 5, // Margin bottom pixel
                'quality' => 95, // JPEG image save quality
                'transparency' => 70, // Water mark image transparency ( other than PNG )
                'targetType' => IMG_GIF | IMG_JPG | IMG_PNG | IMG_WBMP, // Target image formats ( bit-field )
                'targetMinPixel' => 200 // Target image minimum pixel size
            ]
        ]
    ],
    'params' => $params,
];
