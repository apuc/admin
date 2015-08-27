<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

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
                    return Html::a($model->name, ['/pages/pages/update','id'=>$model->id],[]);
                    //return "<a href='http://admin2.web-artcraft.com/page?p=$model->id'>$model->name</a>";
                }
            ],
            /*'images',
            'count_product',
            'hint',*/
            // 'description:ntext',
            // 'title',
            // 'h1',
            // 'keywords',
            // 'blokc_id',

            /*['class' => 'yii\grid\ActionColumn'],*/

            [
                'class'  => DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',
                'value' => function($model){
                    $view = "<a class='targetBlanc' href='http://admin2.web-artcraft.com/page?p=".$model->id."'><img src='".\yii\helpers\Url::base()."crud_img/view.png' width='20px' title='Просмотр'></a>";
                    $view .= Html::a("<img src='".\yii\helpers\Url::base()."crud_img/edit.png' width='20px' title='Редактировать'></a>", ['/pages/pages/update','id'=>$model->id]);
                    $view .= Html::a("<img src='".\yii\helpers\Url::base()."crud_img/del.png' width='20px' title='Удалить'></a>", ['/pages/pages/delete','id'=>$model->id]);
                    return $view;
                }
            ]

        ],
    ]); ?>

</div>
