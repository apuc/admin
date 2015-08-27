<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\supplies\models\Supplies */

$this->title = 'Редактирование материала: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="supplies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'media' => $media,
        'type_mat' => $type_mat,
        'type_blind' => $type_blind,
        'color' => $color,
    ]) ?>

</div>
