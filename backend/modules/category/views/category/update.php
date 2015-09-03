<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\Category */

$this->title = 'Обновление категории: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
/*$this->params['breadcrumbs'][] = 'Редактирование';*/
?>
<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parent' => $parent,
        'media'  => $media,
        'block' => $block,
        'update' => 1
    ]) ?>

</div>
