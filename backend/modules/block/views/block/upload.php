<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput()->label('Загрузить файл') ?>

    <button>Отправить</button>

<?php ActiveForm::end() ?>