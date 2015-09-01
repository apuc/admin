<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\block\models\BlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блоки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить блок', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            'key',
            'name',
            /*'code',*/
            /*'style',*/
           /* [
                'attribute' => 'img',
                'format' => 'html',
                'value' => function($model){
                    if($model->img){
                        return Html::img(\yii\helpers\Url::base()."/".$model->img, ['width'=>'100px'])."<br>".Html::a('Изменить',['/block/add_img', 'id' => $model->id]);
                    }
                    else {
                        return Html::a('Добавить картинку',['/block/add_img', 'id' => $model->id]);
                    }
                }
            ],*/

            [
                'class'  => DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',
                'value' => function($model){
                    /*$view = Html::a("<img src='".\yii\helpers\Url::base()."crud_img/view.png' width='20px' title='Просмотр'></a>", ['/block/block/view','id'=>$model->id]);*/
                    $view = Html::a("<img src='".\yii\helpers\Url::base()."crud_img/edit.png' width='20px' title='Редактировать'></a>", ['/block/block/update','id'=>$model->id]);
                    $view .= Html::a("<img src='".\yii\helpers\Url::base()."crud_img/del.png' width='20px' title='Удалить'></a>", ['/block/block/delete','id'=>$model->id]);
                    return $view;
                }
            ],
        ],
    ]); ?>

</div>
