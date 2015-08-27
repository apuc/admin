<?php

namespace backend\modules\ord\controllers;

use common\models\Orders;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $orders = Orders::find()->orderBy('dt_add DESC')->all();

        return $this->render('index',[
            'orders' => $orders,
        ]);
    }
}
