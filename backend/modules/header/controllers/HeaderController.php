<?php
/**
 * Created by PhpStorm.
 * User: ������
 * Date: 12.08.2015
 * Time: 10:16
 */

namespace backend\modules\header\controllers;

use backend\modules\header\models\HeaderForm;
use common\classes\Debag;
use yii\base\Controller;
use yii\helpers\Url;
use yii;
use common\models\Tpl;
use yii\filters\AccessControl;

class HeaderController extends Controller
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
        $model = new HeaderForm();
        $header = Tpl::find()->where(['key' => 'header'])->one();

        if ($model->load(\Yii::$app->request->post())) {
            $header->code = $model->code;
            $header->style = $model->style;
            $header->save();
            return \Yii::$app->response->redirect('header');
        }
        else {
            $model->code = $header->code;
            $model->style = $header->style;
            return $this->render('index', ['model' => $model,]);
        }
    }
}