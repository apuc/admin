<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 12.08.2015
 * Time: 10:16
 */

namespace backend\modules\header\controllers;

use backend\modules\header\models\HeaderForm;
use common\classes\Debag;
use yii\base\Controller;

class HeaderController extends Controller
{
    public function actionIndex()
    {
        $model = new HeaderForm();

        if ($model->load(\Yii::$app->request->post())) {
            file_put_contents('html/header.php', $model->code);
            file_put_contents('css/header.css', $model->style);
            \Yii::$app->getSession()->setFlash('access', 'Saved');
            return \Yii::$app->response->redirect('header');
        }
        else {
            $model->code = file_get_contents('html/header.php');
            $model->style = file_get_contents('css/header.css');
            return $this->render('index', ['model' => $model,]);
        }
    }
}