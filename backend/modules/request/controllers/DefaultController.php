<?php

namespace backend\modules\request\controllers;

use common\models\Request;
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
        $request = Request::find()->orderBy('dt_add DESC')->all();
        return $this->render('index',[
            'request' => $request,
        ]);
    }
}
