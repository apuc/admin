<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\blind\models\BlindSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Жалюзи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blind-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute'=>'status',
                'format' => 'text',
                'value' => function($model){
                    if($model->status == 1){
                        return 'Опубликовано';
                    }
                    else{
                        return 'Не опубликовано';
                    }
                }
            ],

            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
