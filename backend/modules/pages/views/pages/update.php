<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\pages\models\Pages */

$this->title = 'Редактирование страницы: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="pages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'media' => $media,
        'block' => $block,
    ]) ?>

</div>
