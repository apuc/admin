<?php

namespace backend\modules\blind\controllers;

use backend\modules\supplies\Supplies;
use common\classes\CategoryTree;
use common\classes\Debag;
use common\models\BlindCatid;
use common\models\BlindForm;
use common\models\BlindIdmaterials;
use common\models\BlindImg;
use common\models\BlindMaterials;
use common\models\Categories;
use common\models\Material;
use yii\filters\AccessControl;

use common\models\Media;
use common\models\PageBlinds;
use common\models\PageForTitle;
use common\models\PageItem;
use common\models\PageToBlind;
use Yii;
use backend\modules\blind\models\Blind;
use backend\modules\blind\models\BlindSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;

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
                    'delete' => ['get'],
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

        $materials = \backend\modules\supplies\models\Supplies::find()->all();
        foreach($materials as $v){
            $arr_materials[$v->id] = $v->code;
        }

        $arr_cat = CategoryTree::getTreeSelect(0);
        unset($arr_cat[0]);

        $addMaterials = \common\classes\Supplies::getAddSupplies();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $blind->name = $model->name;
            $blind->status = $model->status;
            $blind->description = $model->description;
            $blind->save();
            if(isset($_POST['infoPage'])){
                foreach($_POST['infoPage'] as $v){
                    $input = explode('*',$v);
                    $s = str_replace('_',' ',$input[0]);
                    $pb = new PageBlinds();
                    $pb->name = $s;
                    $pb->save();
                    unset($input[0]);
                    $ptb = new PageToBlind();
                    $ptb->id_pages = $pb->id;
                    $ptb->id_blind = $blind->id;
                    $ptb->save();
                    foreach($input as $in){
                        $pageItem = new PageItem();
                        $item = explode('_',$in);
                        if($item[1] == 'materials'){
                            $pageItem->id_page = $pb->id;
                            $pageItem->id_item = $item[0];
                            $pageItem->item_type = 'materials';
                        }
                        else{
                            $pageTitle = new PageForTitle();
                            $pageTitle->title = $item[0];
                            $pageTitle->save();
                            $pageItem->id_page = $pb->id;
                            $pageItem->id_item = $pageTitle->id;
                            $pageItem->item_type = 'zagolovok';
                        }
                        $pageItem->id_blind = $blind->id;
                        $pageItem->save();
                    }
                }
            }


            if(isset($_POST['blindTitle'])){
                foreach($_POST['blindTitle'] as $bt){
                    $arrBt = explode('*', $bt);
                    $bmt = new BlindMaterials();
                    $bmt->id_blind = $blind->id;
                    $bmt->id_materials = $arrBt[0];
                    $bmt->title = $arrBt[1];
                    $bmt->save();
                }
            }

            foreach($model->categories as $cat){
                $blindCatId = new BlindCatid();
                $blindCatId->id_blind = $blind->id;
                $blindCatId->id_cat = $cat;
                $blindCatId->save();
            }
            if(!empty($_POST['blind_image'])){
                foreach($_POST['blind_image'] as $img){
                    $blindImg = new BlindImg();
                    $imgarr = explode('*',$img);
                    $blindImg->id_blind = $blind->id;
                    $blindImg->images = $imgarr[0];
                    $blindImg->main = $imgarr[1];
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
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $arr_cat,
                'materials' => $arr_materials,
                'media' => $media,
                'addMat' =>$addMaterials
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
        $model->description = $blind->description;

        $cat = BlindCatid::find()->where(['id_blind' => $id])->all();

        $blindMaterialHeader = BlindMaterials::find()->where(['id_blind'=>$id])->all();
//Debag::prn($_POST);
        foreach($cat as $c){
            $arr_catid[$c->id_cat] = ['selected ' => 'selected'];
        }

        $media = Media::find()->all();

        $supples = BlindIdmaterials::find()->where(['id_blind'=>$id])->all();
        foreach($supples as $supl){
            $arr_supl[$supl->id_materials] = ['selected ' => 'selected'];
        }


        $materials = \backend\modules\supplies\models\Supplies::find()->all();
        foreach($materials as $v){
            $arr_materials[$v->id] = $v->code;
        }
        $arr_cat = CategoryTree::getTreeSelect(0);
        unset($arr_cat[0]);
        $blImg = new BlindImg();
        $imgages = $blImg->find()->where(['id_blind'=>$id])->all();

        $addMaterials = \common\classes\Supplies::getAddSupplies();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $blind->name = $model->name;
            $blind->status = $model->status;
            $blind->description = $model->description;
            $blind->save();


            $delBmt = new BlindMaterials();
            $delBmt->deleteAll(['id_blind'=>$blind->id]);
            if(isset($_POST['blindTitle'])){
                foreach($_POST['blindTitle'] as $bt){
                    $arrBt = explode('*', $bt);
                    $bmt = new BlindMaterials();
                    $bmt->id_blind = $blind->id;
                    $bmt->id_materials = $arrBt[0];
                    $bmt->title = $arrBt[1];
                    $bmt->save();
                }
            }


            $cat = BlindCatid::deleteAll(['id_blind'=>$blind->id]);

            foreach($model->categories as $cat){
                $blindCatId = new BlindCatid();
                $blindCatId->id_blind = $blind->id;
                $blindCatId->id_cat = $cat;
                $blindCatId->save();
            }
            $blindImg = new BlindImg();
            $cat = $blindImg->deleteAll(['id_blind'=>$blind->id]);
            if(!empty($_POST['blind_image'])){
                foreach($_POST['blind_image'] as $img){
                    $blindImg = new BlindImg();
                    $imgarr = explode('*',$img);
                    $blindImg->id_blind = $blind->id;
                    $blindImg->images = $imgarr[0];
                    $blindImg->main = $imgarr[1];
                    $blindImg->save();
                }
            }
            $cat = BlindIdmaterials::deleteAll(['id_blind'=>$blind->id]);
            if(!empty($model->materials)){
                foreach($model->materials as $mat){
                    $blindMat = new BlindIdmaterials();
                    $blindMat->id_blind = $blind->id;
                    $blindMat->id_materials = $mat;
                    $blindMat->save();
                }
            }


//Debag::prn($_POST['infoPage']);
            $zag = PageToBlind::find()->where(['id_blind'=>$blind->id])->all();
            foreach($zag as $v){
                PageBlinds::deleteAll(['id'=>$v->id_pages]);
            }
            PageToBlind::deleteAll(['id_blind'=>$blind->id]);

            if(isset($_POST['infoPage'])){

                foreach($_POST['infoPage'] as $v){
                    $input = explode('*',$v);
                    $s = str_replace('_',' ',$input[0]);
                    $pb = PageBlinds::find()->where(['name'=>$s])->one();

                    if(empty($pb->id)){
                        $pb = new PageBlinds();
                        $pb->name = $s;
                        $pb->save();
                    }
                    //$pb->name = $input[0];
                    //$pb->save();
                    unset($input[0]);
                    $del = PageToBlind::deleteAll(['id_pages'=>$pb->id]);
                    $ptb = new PageToBlind();
                    $ptb->id_pages = $pb->id;
                    $ptb->id_blind = $blind->id;
                    $ptb->save();
                    $cat = PageItem::deleteAll(['id_page'=>$pb->id]);
                    foreach($input as $in){
                   //Debag::prn($in);
                        $pageItem = new PageItem();
                        $item = explode('_',$in);
                        if($item[1] == 'materials'){
                            $pageItem->id_page = $pb->id;
                            $pageItem->id_item = $item[0];
                            $pageItem->item_type = 'materials';
                        }
                        else{
                            $pageTitle = PageForTitle::find()->where(['title'=>$item[0]])->one();
                            if(empty($pageTitle->id)){
                                $pageTitle = new PageForTitle();
                                $pageTitle->title = $item[0];
                                $pageTitle->save();
                            }
                            /*$pageTitle = new PageForTitle();
                            $pageTitle->title = $item[0];
                            $pageTitle->save();*/
                            $pageItem->id_page = $pb->id;
                            $pageItem->id_item = $pageTitle->id;
                            $pageItem->item_type = 'zagolovok';
                        }
                        $pageItem->id_blind = $blind->id;
                        $pageItem->save();
                    }
                }
            }

            else{

            }
            return $this->redirect(['update', 'id' => $blind->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $arr_cat,
                'catselect' => $arr_catid,
                'materials' => $arr_materials,
                'materialselect' => $arr_supl,
                'media' => $media,
                'img' => $imgages,
                'bmt' => $blindMaterialHeader,
                'blind' =>$blind,
                'addMat' =>$addMaterials

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

    public function actionDel_page_blind(){
        $id = PageBlinds::find()->where(['name'=>$_GET[id]])->one();
        $del = PageToBlind::deleteAll(['id_pages'=>$id->id]);
    }

    public function actionPubl_materials(){
        $arr = explode(",", $_GET['val']);
        $html = '';
        foreach($arr as $a){
            if(!empty($a)) {
                $sup = \backend\modules\supplies\models\Supplies::find()->where(['code' => $a])->one();
                if(isset($sup->id)) {
                    $html .= \common\classes\Supplies::getOneAddSupplies($sup->id, $_GET['id_page']);
                }
            }
        }
        return $html;
    }
}
