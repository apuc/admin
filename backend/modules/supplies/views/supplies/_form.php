<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\supplies\models\Supplies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplies-form">

    <?php $form = ActiveForm::begin(); ?>

    <div id="imgLoad">
        <div id="imgPreview">
            <?php
            if(!empty($model->images)){
                echo '<div class="imgadd">';
                echo Html::img($model->images,['width'=>'100px']);
                /*echo Html::hiddenInput('pages-images',$model->images);*/
                //echo $form->field($model, 'images')->hiddenInput()->label("<a data-toggle='modal' data-target='#myModal' href='#'>Обзор</a><a class = 'del_img' href = '#'>Удалить</a>");
                echo '</div>';

            }
            else{
                echo "<div class='imgEmpty'>Изображение</div>";
            }
            ?>
        </div>
        <a data-toggle='modal' data-target='#myModal' href='#'>Обзор</a> |
        <a class = 'del_img_pages' href = '#'>Удалить</a>
    </div>
    <?= $form->field($model, 'images')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'type_mat')->textInput()->dropDownList($type_mat) ?>

    <?= $form->field($model, 'type_blind')->textInput()->dropDownList($type_blind) ?>

    <?= $form->field($model, 'type_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput()->dropDownList($color) ?>
    <div id="colorP" style='width:100px; height:20px'></div>
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
                <form id="htmlForm" action="/secure/media/media/ajax" method="post">
                    Message: <input type="file" name="file"/>
                    <input type="submit" value="Загрузить" />
                </form>

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
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>-->
            </div>
        </div>
    </div>
</div>