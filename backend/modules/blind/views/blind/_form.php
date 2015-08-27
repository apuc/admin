<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\blind\models\Blind */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="blind-form">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#panel1">Общее</a></li>
        <li><a href="#panel2">Материалы</a></li>
    </ul>

    <div class="tab-content">
        <div id="panel1" class="tab-pane fade in active">
            <h3>Общее</h3>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <a data-toggle='modal' data-target='#myModal' href='#'>Добавить изображение</a>
            <div id="imgPreview"></div>
            <div class="blind_images">

                <?php
                if(!empty($img)) {
                    foreach ($img as $v) {
                        echo '<div class="imgadd">';
                        echo Html::img($v->images, ['width' => '150px']);
                        echo Html::hiddenInput('blind_image[]',$v->images.'*'.$v->main);
                        echo Html::a('Удалить', ['#'], ['class' => 'del_img']);

                        if($v->main==0){
                            echo Html::a('Сделать основным', ['#'], ['class' => 'osn']);

                        }else{
                            echo Html::a('Основное', ['#'], ['class' => 'osn']);
                        }
                        echo '</div>';
                    }
                }
                ?>

            </div>

            <?= $form->field($model, 'status')->checkbox() ?>

            <?=$form->field($model, 'categories')->dropDownList($categories, ['multiple'=>true, 'options' => $catselect]) ?>
            <?/*= Html::dropDownList('category',) */?>

           <!-- --><?/*= $form->field($model, 'images')->hiddenInput(['class'])->label('') */?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div id="panel2" class="tab-pane fade">
            <h3>Материалы</h3>
            <?=$form->field($model, 'materials')->dropDownList($materials, ['multiple'=>true, 'options' => $materialselect]) ?>
            <a data-toggle='modal' data-target='#myModal2' href = "#">Добавить заголовок</a>
            <div id="addinp">
                <?php
                if(isset($bmt)){
                    foreach($bmt as $b){
                        echo '<div style = "margin-top:5px;">';
                        echo $b->title.'заголовок будет вставлен перед ' .\backend\modules\supplies\models\Supplies::getSupName($b->id_materials). '<input type="hidden" name="blindTitle[]"  value="' .$b->id_materials. '*' .$b->title. '"/> | <a href="#" id="delTitle">Удалить</a> </div>';
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>



    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
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
                        ".Html::img(\yii\helpers\Url::base()."/".$m->link, ['width'=>'150px', 'class' => 'PrevImg'])."

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

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Название модали</h4>
            </div>
            <div class="modal-body">
                <?php $materials[0] = 'Выберите материал'; ?>
            <?= Html::textInput('titleB', '', ['id'=>'titleB', 'placeholder'=>'Название заголовка']) ?>
            <?= Html::dropDownList('forM', 0, $materials,['id'=>'selmat']) ?>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>-->
                <button id = "addTitle" type="button" class="btn btn-default">Добавить</button>
            </div>
        </div>
    </div>
</div>
