<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\supplies\models\SuppliesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Материалы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать материал', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            [
                'attribute'=>'image',
                'format' => 'html',
                'value' => function($model){
                    return "<img src='$model->images' width='100px'>";
                }
            ],
            'code',
            [
                'attribute'=>'type_mat',
                'format' => 'text',
                'value' => function($model){
                    $material = \common\models\Material::find()->where(['id' => $model->type_mat])->one();
                    return $material->name;
                }
            ],
            [
                'attribute'=>'type_blind',
                'format' => 'text',
                'value' => function($model){
                    if($model->type_blind == '1'){
                        return 'Горизантальные';
                    }
                    if($model->type_blind == '2'){
                        return 'рулонные';
                    }
                    if($model->type_blind == '3'){
                        return 'вертикальные';
                    }

                }
            ],

            // 'type_width',
            [
                'attribute'=>'color',
                'format' => 'html',
                'value' => function($model){
                    $color = \common\models\Color::find()->where(['id'=>$model->color])->one();
                    return '<div style = "width:100px;height:20px;background-color: '.$color->value.'"></div>';
                }
            ],
             'price',
            // 'status',

            [
                'class'  => DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',
                'value' => function($model){
                    $view = Html::a("<img src='".\yii\helpers\Url::base()."crud_img/view.png' width='20px' title='Просмотр'></a>", ['/supplies/supplies/view','id'=>$model->id]);
                    $view .= Html::a("<img src='".\yii\helpers\Url::base()."crud_img/edit.png' width='20px' title='Редактировать'></a>", ['/supplies/supplies/update','id'=>$model->id]);
                    $view .= Html::a("<img src='".\yii\helpers\Url::base()."crud_img/del.png' width='20px' title='Удалить'></a>", ['/supplies/supplies/delete','id'=>$model->id]);
                    return $view;
                }
            ],
        ],
    ]); ?>

</div>
