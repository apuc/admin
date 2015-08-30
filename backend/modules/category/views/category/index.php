<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <table class="table table-striped table-bordered"><thead>
        <tr><th>#</th><th><span>Название</span></th><th>Действия</th></tr>
        </thead><tbody>
    <?php
    \common\classes\CategoryTree::getTree(0);
    ?>
        </tbody></table>

</div>
