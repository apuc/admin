<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\supplies\models\Supplies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'images')->textInput(['maxlength' => true])->label("Изображение (<a data-toggle='modal' data-target='#myModal' href='#'>Добавить</a>)") ?>
    <div id = 'imgPreview'></div>
    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'type_mat')->textInput()->dropDownList($type_mat) ?>

    <?= $form->field($model, 'type_blind')->textInput()->dropDownList($type_blind) ?>

    <?= $form->field($model, 'type_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput()->dropDownList($color) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Название модали</h4>
            </div>
            <div class="modal-body">
                <div class="mediaWrap">
                    <h3>Существующие файлы:</h3>
                    <?php
                    foreach ($media as $m) {
                        echo "
        <div class='mediaBox'>
            ".Html::img(\yii\helpers\Url::base()."/".$m->link, ['width'=>'150px', 'class' => 'imgPrev'])."

            <input id='img_$m->id' type='hidden' value='".\yii\helpers\Url::base(true)."/".$m->link."'>
        </div>";
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>