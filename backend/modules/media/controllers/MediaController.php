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

class MediaController extends Controller
{
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
}