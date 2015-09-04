<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\Category */
/* @var $form yii\widgets\ActiveForm */


?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'tab')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>
<?php
$tabMenu1 = '';
$tabMenu2 = '';
$tabMenu3 = '';
$tabContent1 = '';
$tabContent2 = '';
$tabContent3 = '';
if($model->tab == '#panel1' or $model->tab == ''){
    $tabMenu1 = 'class="active"';
    $tabContent1 = 'in active';
}
if($model->tab == '#panel2'){
    $tabMenu2 = 'class="active"';
    $tabContent2 = 'in active';
}
if($model->tab == '#panel3'){
    $tabMenu3 = 'class="active"';
    $tabContent3 = 'in active';
}
?>
<div class="category-form">
    <div id="validMsg" style="margin: 10px"></div>
    <ul id="myTab" class="nav nav-tabs">
        <li <?= $tabMenu1; ?>><a href="#panel1">Общее</a></li>
        <li <?= $tabMenu2; ?>><a href="#panel2">Вид</a></li>
        <li <?= $tabMenu3; ?>><a href="#panel3">SEO</a></li>

    </ul>

    <div class="tab-content">
        <div id="panel1" class="tab-pane fade <?= $tabContent1 ?>">
            <h3>Общее</h3>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'parent_id')->dropDownList($parent) ?>
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
            <?= $form->field($model, 'fix_menu')->dropDownList(['0' => 'Не прикреплять', '1' => 'Меню 1-го уровня', '2' => 'Меню 2-го уровня']) ?>
            <?= $form->field($model, 'count_product')->textInput() ?>
            <?= $form->field($model, 'hint')->textInput(['maxlength' => true]) ?>
            <?/*= $form->field($model, 'description')->textarea(['rows' => 6]) */?>
            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'standard',
                    'inline' => false,
                ]),
            ]) ?>
        </div>
        <div id="panel2" class="tab-pane fade <?= $tabContent2 ?>">
            <h3>Вид</h3>
            <?= $form->field($model, 'blokc_id')->dropDownList($block) ?>
            <?= Html::button('Добавить блок', ['class' => 'btn btn-success', 'id' => 'addCustBlock']) ?>
            <br>
            <hr>
            <a id="specialBlockToggle" href="#">Индивидуальный блок</a>
            <div id="specialBlock">
                <?= Html::textInput('indBlockName', '', ['id'=>'indBlockName', 'class'=>'form-control', 'placeholder'=>'Имя индивидуального блока']) ?>
                <?= $form->field($model, 'code')->textarea(['rows' => 6, 'id' => 'indBlockCode'])->label('Код') ?>
                <?= $form->field($model, 'style')->textarea(['rows' => 6, 'id' => 'indBlockStyle'])->label('Стиль') ?>
                <?= Html::button('Добавить индивидуальный блок', ['class' => 'btn btn-success', 'id' => 'addIndBlock']) ?>
            </div>
            <h3>Порядок блоков</h3>
            <?= $form->field($model, 'sort')->hiddenInput(['class'=>'sortBlock'])->label('') ?>
            <?= $form->field($model, 'sort_all')->hiddenInput(['class'=>'sortBlockAll'])->label('') ?>
            <div>
                <ul id="sort">
                    <?php


                        if($model->sort_all != ''){
                            $sortDefault = explode(',', $model->sort_all);
                        }
                        else {
                            $sortDefault = [];
                        }
                        if(!in_array('des', $sortDefault)){
                            $sortDefault[] = 'des';
                        }
                        $sort = explode(',', $model->sort);
                        if($model->sort != ''){
                            foreach ($sort as $s) {
                                if($s[0] == 'y'){
                                    $blockId = explode('_', $s);
                                    $blockId = $blockId[1];
                                    $block = \common\models\Block::find()->where(['id'=>$blockId])->one();
                                    $name = $block->name;
                                    echo '<li class="published sortAll" data-type="'.$s.'">'.$name.' | <a class="toPublick" href="#">Скрыть</a> | <a class="delCustBlock" href="#">Удалить</a></li>';
                                }
                                elseif($s[0] == 'i'){
                                    $blockId = explode('_', $s);
                                    $blockId = $blockId[1];
                                    $block = \common\models\Block::find()->where(['id'=>$blockId])->one();
                                    $name = $block->name;
                                    echo '<li class="published sortAll" data-type="'.$s.'">Индивидуальный блок ('.$name.') | <a class="toPublick" href="#">Скрыть</a> | <a class="editIndBlock" data-block-id="'.$blockId.'" href="#">Редактировать</a> | <a class="delCustBlock" href="#">Удалить</a></li>';
                                }
                                else {
                                    $name = \common\classes\Template::getBlockName($s);
                                    echo '<li class="published sortAll" data-type="'.$s.'">'.$name.' | <a class="toPublick" href="#">Скрыть</a></li>';
                                }

                                $value_to_delete = $s ; //Элемент с этим значением нужно удалить
                                $sortDefault = array_flip($sortDefault); //Меняем местами ключи и значения
                                unset ($sortDefault[$value_to_delete]) ; //Удаляем элемент массива
                                $sortDefault= array_flip($sortDefault); //Меняем местами ключи и значения
                            }
                        }


                        foreach($sortDefault as $sd){
                            if($sd[0] == 'y'){
                                $name = explode('_', $sd);
                                $name = \common\models\Block::find()->where(['id'=>$name[1]])->one();
                                $name = $name->name;
                                echo '<li class="noPublick sortAll" data-type="'.$sd.'">'.$name.' | <a class="toPublick" href="#">Опубликовать</a> | <a class="delCustBlock" href="#">Удалить</a></li>';
                            }
                            elseif($sd[0] == 'i'){
                                $blockId = explode('_', $sd);
                                $blockId = $blockId[1];
                                $block = \common\models\Block::find()->where(['id'=>$blockId])->one();
                                $name = $block->name;
                                echo '<li class="noPublick sortAll" data-type="'.$sd.'">Индивидуальный блок ('.$name.') | <a class="toPublick" href="#">Опубликовать</a> | <a class="editIndBlock" data-block-id="'.$blockId.'" href="#">Редактировать</a> | <a class="delCustBlock" href="#">Удалить</a></li>';
                            }
                            else {
                                $name = \common\classes\Template::getBlockName($sd);
                                echo '<li class="noPublick sortAll" data-type="'.$sd.'">'.$name.' | <a class="toPublick" href="#">Опубликовать</a></li>';
                            }
                        }

                    ?>
                </ul>
            </div>
        </div>
        <div id="panel3" class="tab-pane fade <?= $tabContent3 ?>">
            <h3>SEO</h3>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'validMy']) ?>
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