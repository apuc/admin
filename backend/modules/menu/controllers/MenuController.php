<?php

namespace backend\modules\menu\controllers;

use common\classes\Debag;
use common\models\Media;
use Yii;
use backend\modules\menu\models\Menu;
use backend\modules\menu\models\MenuSearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                    'update_el' => ['get'],
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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $media = Media::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'media' => $media,
        ]);
    }

    /**
     * Displays a single Menu model.
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();
        $media = Media::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'media' => $media
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $media = Media::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'media' => $media
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpdate_el()
    {
        $menu = Menu::findOne(['id' => $_GET['id']]);
        if ($_GET['parent_id'] == 'undefined') {
            $menu->parent_id = 0;
        } else {
            $menu->parent_id = $_GET['parent_id'];
        }

        $menu->save();
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionEdit_menu()
    {
        $menu = Menu::find()->where(['id' => $_GET['id']])->one();
        echo "<div class='edit_menu'>";
        echo Html::textInput('name', $menu->name, ['id' => 'menu_name', 'class' => 'form-control']);
        echo Html::textInput('url', $menu->url, ['id' => 'menu_url', 'class' => 'form-control']);
        ?>
        <div id="imgLoad">
            <div id="imgPreview">
                <?php
                if (!empty($menu->icon)) {
                    echo '<div class="imgadd">';
                    echo Html::img($menu->icon, ['width' => '100px', 'id' => 'menu_icon']);
                    /*echo Html::hiddenInput('pages-images',$model->images);*/
                    //echo $form->field($model, 'images')->hiddenInput()->label("<a data-toggle='modal' data-target='#myModal' href='#'>Обзор</a><a class = 'del_img' href = '#'>Удалить</a>");
                    echo '</div>';

                } else {
                    echo "<div class='imgEmpty'>Изображение</div>";
                }
                ?>
            </div>
            <a data-toggle='modal' class="btn btn-warning" data-target='#myModal' href='#'>Обзор</a> |
            <a class='del_img_pages btn btn-warning'  href='#'>Удалить</a>
        </div>
        <div class="cleared"></div>
        <br>
        <?php
        echo Html::textarea('descr', $menu->descr, ['id' => 'menu_descr', 'class' => 'form-control', 'rows' => '5']);
        echo Html::button('Сохранить', ['class' => 'btn btn-success', 'id' => 'saveMenu', 'data-id' => $menu->id]);
        echo Html::button('Отмена', ['class' => 'btn btn-success', 'id' => 'closeMenu', 'style' => 'margin-left:5px']);
        echo "</div>";
    }

    public function actionSave_menu()
    {
        $menu = Menu::find()->where(['id' => $_GET['id']])->one();
        $menu->name = $_GET['name'];
        $menu->url = $_GET['url'];
        $menu->descr = $_GET['descr'];
        if ($_GET['icon'] == 'undefined') {
            $menu->icon = '';
        } else {
            $menu->icon = $_GET['icon'];
        }
        $menu->save();
    }
}
