<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\color\models\Color */

$this->title = 'Редактировать цвет';
$this->params['breadcrumbs'][] = ['label' => 'Цвет', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->value;
/*$this->params['breadcrumbs'][] = 'Редактировать';*/
?>
<div class="color-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
