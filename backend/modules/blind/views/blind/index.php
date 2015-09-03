<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
use common\models\PageToBlind;
use common\models\PageItem;
use backend\modules\supplies\models\Supplies;

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

            /*'id',*/
            [

                'attribute' => 'name',
                'format' => 'html',
                'value' => function ($model) {
                    return "<div style='width: 300px'>$model->name</div>";
                }

            ],
            [
                'class' => DataColumn::className(),
                'header' => 'Раздел',
                'format' => 'html',
                'value' => function ($model) {
                    $cat = \common\models\BlindCatid::find()->where(['id_blind' => $model->id])->all();
                    $title = '<ul style="width: 400px">';
                    foreach ($cat as $c) {
                        $catObj = \backend\modules\category\models\Category::find()->where(['id' => $c->id_cat])->one();
                        $title .= "<li>" . $catObj->name . "</li>";
                    }
                    $title .= "</ul>";
                    return $title;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function ($model) {
                    if ($model->status == 1) {
                        return 'Опубликовано';
                    } else {
                        return 'Не опубликовано';
                    }
                }
            ],

            [
                'class' => DataColumn::className(),
                'header' => 'Цена',
                'format' => 'html',
                'value' => function ($model) {
                    $page2BlindID = PageToBlind::find()->where(['id_blind' => $model->id])->all();
                    $supIds = [];
                    foreach ($page2BlindID as $page) {
                        $s = PageItem::find()->where(['id_page' => $page->id_pages, 'item_type' => 'materials'])->all();
                        $supIds = array_merge($supIds, $s);
                    }
                    foreach ($supIds as $s) {
                        $sup = Supplies::find()->where(['id' => $s->id_item])->one();
                        $prices[] = $sup->price;
                    }
                    if (isset($prices) && !empty($prices)) {
                        $pricesMin = min($prices);
                        $pricesMax = max($prices);
                    }
                    return "<div style='width: 100px'>".$pricesMin . " - " . $pricesMax."</div>";
                }
            ],
            /*'description:ntext',*/

            [
                'class' => DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',
                'value' => function ($model) {
                    /*$view = Html::a("<img src='".\yii\helpers\Url::base()."crud_img/view.png' width='20px' title='Просмотр'></a>", ['/blind/blind/view','id'=>$model->id]);*/
                    $view = Html::a("<img src='" . \yii\helpers\Url::base() . "crud_img/edit.png' width='20px' title='Редактировать'></a>", ['/blind/blind/update', 'id' => $model->id]);
                    $view .= Html::a("<img src='" . \yii\helpers\Url::base() . "crud_img/del.png' width='20px' title='Удалить'></a>", ['/blind/blind/delete', 'id' => $model->id]);
                    return $view;
                }
            ],
        ],
    ]); ?>

</div>
