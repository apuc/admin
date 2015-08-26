<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\pages\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function($model){
                    //return Html::a($model->name, ['http://admin2.web-artcraft.com/page','p'=>$model->id],[]);
                    return "<a href='http://admin2.web-artcraft.com/page?p=$model->id'>$model->name</a>";
                }
            ],
            'images',
            'count_product',
            'hint',
            // 'description:ntext',
            // 'title',
            // 'h1',
            // 'keywords',
            // 'blokc_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
