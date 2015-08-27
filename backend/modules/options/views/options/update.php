<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\options\models\Options */

$this->title = 'Редактирование опции: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Опции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'update' => 1,
    ]) ?>

</div>
