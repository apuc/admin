<?php

namespace backend\modules\supplies\controllers;

use common\classes\Debag;
use common\models\Color;
use common\models\Material;
use common\models\Media;
use Yii;
use backend\modules\supplies\models\Supplies;
use backend\modules\supplies\models\SuppliesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuppliesController implements the CRUD actions for Supplies model.
 */
class SuppliesController extends Controller
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
     * Lists all Supplies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuppliesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Supplies model.
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
     * Creates a new Supplies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Supplies();
        $media = Media::find()->all();
        $type_blind = array(0=>'Выберите тип жалюзей',1=>'горизонтальные',2=>'рулонные',3=>'вертикальные');
        $type_mat = Material::find()->all();

        $arr_tmat[0] = 'Выберите тип материала';
        foreach ($type_mat as $v) {
            $arr_tmat[$v->id] = $v->name;
        }

        $color = Color::find()->all();
        $arr_color[0] = 'Выберите цвет';
        foreach($color as $v){
            $arr_color[$v->id] = $v->value;
        }

       // if ($form->load(Yii::$app->request->post()) && $form->validate()) {}

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'media' => $media,
                'type_mat' => $arr_tmat,
                'type_blind' => $type_blind,
                'color' => $arr_color,
            ]);
        }
    }

    /**
     * Updates an existing Supplies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $media = Media::find()->all();
        $type_mat = Material::find()->all();
        $type_blind = array(0=>'Выберите тип жалюзеу',1=>'горизонтальные',2=>'рулонные',3=>'вертикальные');
        $arr_tmat[0] = 'Выберите тип материала';
        foreach ($type_mat as $v) {
            $arr_tmat[$v->id] = $v->name;
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'media' => $media,
                'type_mat' => $arr_tmat,
                'type_blind' => $type_blind,
            ]);
        }
    }

    /**
     * Deletes an existing Supplies model.
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
     * Finds the Supplies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Supplies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supplies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
