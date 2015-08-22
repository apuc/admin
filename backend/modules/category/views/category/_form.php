<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\Category */
/* @var $form yii\widgets\ActiveForm */


?>
<?php $form = ActiveForm::begin(); ?>
<div class="category-form">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#panel1">Общее</a></li>
        <li><a href="#panel2">Вид</a></li>
        <li><a href="#panel3">SEO</a></li>

    </ul>

    <div class="tab-content">
        <div id="panel1" class="tab-pane fade in active">
            <h3>Общее</h3>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'parent_id')->dropDownList($parent) ?>
            <?= $form->field($model, 'images')->textInput(['maxlength' => true])->label("Изображение (<a data-toggle='modal' data-target='#myModal' href='#'>Добавить</a>)") ?>
            <?= $form->field($model, 'count_product')->textInput() ?>
            <?= $form->field($model, 'hint')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div id="panel2" class="tab-pane fade">
            <h3>Вид</h3>
            <?= $form->field($model, 'blokc_id')->dropDownList($block) ?>
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