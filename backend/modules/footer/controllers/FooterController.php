<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 12.08.2015
 * Time: 11:31
 */

namespace backend\modules\footer\controllers;


use backend\modules\footer\models\FooterForm;
use yii\base\Controller;
use common\models\Tpl;
use yii\filters\AccessControl;

class FooterController extends Controller
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
        $model = new FooterForm();
        $footer = Tpl::find()->where(['key' => 'footer'])->one();

        if ($model->load(\Yii::$app->request->post())) {
            $footer->code = $model->code;
            $footer->style = $model->style;
            $footer->save();
            return \Yii::$app->response->redirect('footer');
        }
        else {
            $model->code = $footer->code;
            $model->style = $footer->style;
            return $this->render('index', ['model' => $model,]);
        }
    }
}