<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\Category */

$this->title = 'Добавить категорию';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parent' => $parent,
        'media' => $media,
        'block' => $block
    ]) ?>

</div>
