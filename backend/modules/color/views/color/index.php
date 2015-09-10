<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\color\models\ColorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Цвета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить цвет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            [
                'attribute' => 'value',
                'label' => 'Цвет',
                'format' => 'html',
                'value' => function($model){
                    return "<div style='width: 100px;height: 20px;background-color: ".$model->value."'></div> (".$model->value.")";
                }
            ],

            [
                'class'  => DataColumn::className(),
                'header' => 'Действия',
                'format' => 'raw',
                'value' => function($model){
                    /*$view = Html::a("<img src='".\yii\helpers\Url::base()."crud_img/view.png' width='20px' title='Просмотр'></a>", ['/color/color/view','id'=>$model->id]);*/
                    $view = Html::a("<img src='".\yii\helpers\Url::base()."crud_img/edit.png' width='20px' title='Редактировать'></a>", ['/color/color/update','id'=>$model->id]);
                    $view .= Html::a("<img src='".\yii\helpers\Url::base()."crud_img/del.png' width='20px' title='Удалить'></a>", ['/color/color/delete','id'=>$model->id],['data-confirm' => 'Удалить цвет?']);
                    return $view;
                }
            ],
        ],
    ]); ?>

</div>
