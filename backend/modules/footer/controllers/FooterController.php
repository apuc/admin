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

class FooterController extends Controller
{
    public function actionIndex()
    {
        $model = new FooterForm();

        if ($model->load(\Yii::$app->request->post())) {
            file_put_contents('html/footer.php', $model->code);
            file_put_contents('css/footer.css', $model->style);
            \Yii::$app->getSession()->setFlash('access', 'Сохранено');
            return \Yii::$app->response->redirect('footer');
        }
        else {
            $model->code = file_get_contents('html/footer.php');
            $model->style = file_get_contents('css/footer.css');
            return $this->render('index', ['model' => $model,]);
        }
    }
}