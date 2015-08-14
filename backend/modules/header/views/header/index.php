<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'header-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($model, 'code')->textarea(['rows'=>6])->label('Код шапки') ?>
<?= $form->field($model, 'style')->textarea(['rows'=>6])->label('Стили шапки') ?>

<div class="form-group">
    <div class="col-lg-12">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<?= Yii::$app->session->getFlash('access'); ?>