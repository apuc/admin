<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\supplies\models\SuppliesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'images') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'type_mat') ?>

    <?= $form->field($model, 'type_blind') ?>

    <?php // echo $form->field($model, 'type_width') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
