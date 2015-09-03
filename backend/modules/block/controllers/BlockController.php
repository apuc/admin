<?php

namespace backend\modules\block\controllers;

use common\classes\Debag;
use Yii;
use backend\modules\block\models\Block;
use backend\modules\block\models\BlockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\block\models\form\AddImgBlock;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * BlockController implements the CRUD actions for Block model.
 */
class BlockController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                    /*'add_ind_block' => ['post'],*/
                ],
            ],
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

    /**
     * Lists all Block models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Block model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Block model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Block();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->img = '';
            $model->key = 'block';
            $model->type = '';
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Block model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->key = 'block';
            $model->type= '';
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAdd_img(){
        $model = new AddImgBlock();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $block = Block::findOne(['id' => $_GET['id']]);

            if ($model->file && $model->validate()) {
                $model->file->saveAs('block_img/' . $block->id . '.' . $model->file->extension);

                $block->img = 'block_img/' . $block->id . '.' . $model->file->extension;
                $block->save();

                $this->redirect('block');
            }
        }
        else {
            return $this->render('upload', ['model' => $model]);
        }

    }

    /**
     * Deletes an existing Block model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAdd_ind_block(){
        $block = new Block();
        $block->name = $_POST['name'];
        if($_POST['code'] == ''){
            $block->code = 0;
        }
        else {
            $block->code = $_POST['code'];
        }

        if($_POST['style'] == ''){
            $block->style = 0;
        }
        else {
            $block->style = $_POST['style'];
        }
        $block->type = 'ind';
        $block->key = 'ind_';
        $block->save();
        echo $block->id;
    }

    /**
     * Finds the Block model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Block the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Block::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCreate_block_form(){
        //Debag::prn($_POST);
        $block_id = $_POST['blockId'];
        //$block_id = 26;

        $modelBlock = Block::find()->where(['id' => $block_id])->one();

        $form = $this->renderAjax('ajax_block_form',['model' => $modelBlock]);

        echo $form;
    }

    public function actionSave_block_form(){
        $blockId = $_POST['blockId'];
        $blockStyle = $_POST['blockStyle'];
        $blockCode = $_POST['blockCode'];

        $modelBlock = Block::find()->where(['id' => $blockId])->one();

        $modelBlock->code = $blockCode;
        $modelBlock->style = $blockStyle;

        $modelBlock->save();
    }
}
