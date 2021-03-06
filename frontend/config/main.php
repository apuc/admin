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
    'modules' => [
        'mainpage' => [
            'class' => 'frontend\modules\mainpage\Mainpage',
        ],
        'page' => [
            'class' => 'frontend\modules\page\Page',
        ],
        'category' => [
            'class' => 'frontend\modules\category\Category',
        ],
    ],
    'components' => [
        'request'      => [
            'baseUrl' => '',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                '' => 'mainpage/mainpage',
                'page' => 'page/page',
                'category' => 'category/category',
                'get_sup' => 'category/category/get_sup',
                'get_order' => 'category/category/get_order',
                'get_page' => 'category/category/get_page',
                'get_count_items' => 'category/category/get_count_items',
                'get_callme' => 'page/page/get_callme',
                'get_order_zam' => 'category/category/get_order_zam',
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
