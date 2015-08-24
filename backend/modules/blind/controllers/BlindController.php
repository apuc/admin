<?php

namespace backend\modules\blind\controllers;

use backend\modules\supplies\Supplies;
use common\classes\CategoryTree;
use common\classes\Debag;
use common\models\BlindCatid;
use common\models\BlindForm;
use common\models\BlindIdmaterials;
use common\models\BlindImg;
use common\models\Categories;
use common\models\Material;

use common\models\Media;
use Yii;
use backend\modules\blind\models\Blind;
use backend\modules\blind\models\BlindSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlindController implements the CRUD actions for Blind model.
 */
class BlindController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Blind models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlindSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blind model.
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
     * Creates a new Blind model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $blind = new Blind();
        $model = new BlindForm();
        $media = Media::find()->all();
        //$materials = Supplies::find()->all();
        $materials = \backend\modules\supplies\models\Supplies::find()->all();
        foreach($materials as $v){
            $arr_materials[$v->id] = $v->code;
        }
        //$categories = Categories::find()->all();
        $arr_cat = CategoryTree::getTreeSelect(0);
        unset($arr_cat[0]);
        /*foreach($categories as $v){
            $arr_cat[$v->id] = $v->name;
        }*/
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $blind->name = $model->name;
            $blind->status = $model->status;
            $blind->description = $model->description;
            $blind->save();

            foreach($model->categories as $cat){
                $blindCatId = new BlindCatid();
                $blindCatId->id_blind = $blind->id;
                $blindCatId->id_cat = $cat;
                $blindCatId->save();
            }
            if(!empty($model->blind_image)){
                foreach($model->blind_image as $img){
                    $blindImg = new BlindImg();
                    $blindImg->id_blind = $blind->id;
                    $blindImg->images = $img;
                    $blindImg->save();
                }
            }
            if(!empty($model->materials)){
                foreach($model->materials as $mat){
                    $blindMat = new BlindIdmaterials();
                    $blindMat->id_blind = $blind->id;
                    $blindMat->id_materials = $mat;
                    $blindMat->save();
                }
            }
            return $this->redirect(['view', 'id' => $blind->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $arr_cat,
                'materials' => $arr_materials,
                'media' => $media,
            ]);
        }
    }

    /**
     * Updates an existing Blind model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $blind = Blind::find()->where(['id'=>$id])->one();
        $model = new BlindForm();

        $model->name = $blind->name;
        $model->status = $blind->status;

        $cat = BlindCatid::find()->where(['id_blind' => $id])->all();

        foreach($cat as $c){
            $arr_catid[$c->id_cat] = ['selected ' => 'selected'];
        }

        $media = Media::find()->all();
        $materials = Material::find()->all();
        foreach($materials as $v){
            $arr_materials[$v->id] = $v->name;
        }
        $arr_cat = CategoryTree::getTreeSelect(0);
        unset($arr_cat[0]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $blind->name = $model->name;
            $blind->status = $model->status;
            $blind->description = $model->description;
            $blind->save();

            foreach($model->categories as $cat){
                $blindCatId = new BlindCatid();
                $blindCatId->id_blind = $blind->id;
                $blindCatId->id_cat = $cat;
                $blindCatId->save();
            }
            if(!empty($model->blind_image)){
                foreach($model->blind_image as $img){
                    $blindImg = new BlindImg();
                    $blindImg->id_blind = $blind->id;
                    $blindImg->images = $img;
                    $blindImg->save();
                }
            }
            if(!empty($model->materials)){
                foreach($model->materials as $mat){
                    $blindMat = new BlindIdmaterials();
                    $blindMat->id_blind = $blind->id;
                    $blindMat->id_materials = $mat;
                    $blindMat->save();
                }
            }
            return $this->redirect(['view', 'id' => $blind->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $arr_cat,
                'catselect' => $arr_catid,
                'materials' => $arr_materials,
                'media' => $media,
            ]);
        }
    }

    /**
     * Deletes an existing Blind model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blind model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blind the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blind::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
