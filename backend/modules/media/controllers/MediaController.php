<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 17.08.2015
 * Time: 11:21
 */

namespace backend\modules\media\controllers;


use common\classes\Debag;
use common\models\Media;
use yii\web\Controller;
use backend\modules\block\models\form\AddImgBlock;
use yii\web\UploadedFile;
use yii;
use yii\helpers\Html;
use yii\filters\AccessControl;

class MediaController extends Controller
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

    public function actionIndex(){
        $model = new AddImgBlock();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $media = new Media();

            if ($model->file && $model->validate()) {
                $model->file->saveAs('media_file/' . $model->file->baseName . '.' . $model->file->extension);
                $media->link = 'media_file/' . $model->file->baseName . '.' . $model->file->extension;
                $media->save();

                $this->redirect('media');
            }
        }
        else {
            $media = Media::find()->all();
            return $this->render('index', ['model' => $model, 'media' => $media]);
        }
    }

    public function actionDelete(){
        $media = Media::findOne(['id' => $_GET['id']]);
        $media->delete();
        $this->redirect('media');
    }

    public function actionAjax(){
        $media = new Media();
        $uploaddir = 'media_file/';
        $uploadfile = $uploaddir.basename($_FILES['file']['name']);
        if(!empty($_FILES)){
            if (copy($_FILES['file']['tmp_name'], $uploadfile))
            {
                $media->link = $uploadfile;
                $media->save();


            }
        }

        $mediaAll = Media::find()->all();
        foreach ($mediaAll as $m) {
            echo "
        <div class='mediaBox'>
            ".Html::img(\yii\helpers\Url::base()."/".$m->link, ['width'=>'150px', 'class' => 'imgPrev'])."
            <input type='hidden' value='".\yii\helpers\Url::base(true)."/".$m->link."'>
        </div>";
        }
    }
}