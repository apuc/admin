<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\pages\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="pages-form">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#panel1">Общее</a></li>
        <li><a href="#panel2">Вид</a></li>
        <li><a href="#panel3">SEO</a></li>

    </ul>
    <div class="tab-content">
        <div id="panel1" class="tab-pane fade in active">
            <h3>Общее</h3>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'images')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'count_product')->textInput() ?>
            <?= $form->field($model, 'hint')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div id="panel2" class="tab-pane fade">
            <h3>Вид</h3>
            <?= $form->field($model, 'blokc_id')->textInput() ?>
        </div>
        <div id="panel3" class="tab-pane fade">
            <h3>SEO</h3>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
