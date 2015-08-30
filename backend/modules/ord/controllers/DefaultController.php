<?php

namespace backend\modules\ord\controllers;

use common\models\Orders;
use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $orders = Orders::find()->orderBy('dt_add DESC')->all();

        return $this->render('index',[
            'orders' => $orders,
        ]);
    }
}
