<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\supplies\models\Supplies */

$this->title = 'Create Supplies';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'media' => $media,
        'type_mat' => $type_mat,
        'type_blind' => $type_blind,
        'color' => $color,
    ]) ?>

</div>
