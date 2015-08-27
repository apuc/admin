<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\options\models\Options */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="options-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if(isset($update)){ ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hiddenInput()->label('') ?>

        <?= $form->field($model, 'key')->textInput(['maxlength' => true])->hiddenInput()->label('') ?>
    <?php }
    else { ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
    <?php } ?>



    <?= $form->field($model, 'value')->textInput(['maxlength' => true])->label($model->name) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
