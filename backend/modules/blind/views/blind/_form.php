<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\modules\blind\models\Blind */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'tab')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>
<?php
$tabMenu1 = '';
$tabMenu2 = '';
$tabContent1 = '';
$tabContent2 = '';
if($model->tab == '#panel1' or $model->tab == ''){
    $tabMenu1 = 'class="active"';
    $tabContent1 = 'in active';
}
if($model->tab == '#panel2'){
    $tabMenu2 = 'class="active"';
    $tabContent2 = 'in active';
}
?>

<div class="blind-form">
    <ul id="myTab" class="nav nav-tabs">
        <li <?=$tabMenu1;?>><a href="#panel1">Общее</a></li>
        <li <?=$tabMenu2;?>><a href="#panel2">Материалы</a></li>
    </ul>

    <div class="tab-content">
        <div id="panel1" class="tab-pane fade <?=$tabContent1;?>">
            <h3>Общее</h3>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <div id="imgPreview"></div>
            <div class="blind_images">

                <?php
                if(!empty($img)) {
                    foreach ($img as $v) {
                        echo '<div class="imgadd">';
                        echo Html::img($v->images, ['width' => '150px']);
                        echo Html::hiddenInput('blind_image[]',$v->images.'*'.$v->main);
                        echo Html::a('Удалить', ['#'], ['class' => 'del_img btn btn-warning']);

                        if($v->main==0){
                            echo Html::a('Основное', ['#'], ['class' => 'osn btn btn-warning']);

                        }else{
                            echo Html::a('Основное', ['#'], ['class' => 'osn btn btn-default','disabled'=>'disabled']);
                        }
                        echo '</div>';
                    }
                }
                ?>

            </div>

            <a data-toggle='modal' data-target='#myModal' href='#' class="btn btn-warning">Добавить изображение</a>
            <div class="cleared"></div>
            <?= $form->field($model, 'status')->checkbox(); ?>

            <?=$form->field($model, 'categories')->dropDownList($categories, ['multiple'=>true, 'options' => $catselect]) ?>
            <?/*= Html::dropDownList('category',) */?>

           <!-- --><?/*= $form->field($model, 'images')->hiddenInput(['class'])->label('') */?>

            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                    'preset' => 'standard',
                    'inline' => false,
                ]),
            ]) ?>
        </div>
        <div id="panel2" class="tab-pane fade <?=$tabContent2?>">
            <h3>Материалы</h3>

            <?=$form->field($model,'pagename')->textInput(['maxlength' => true,'class'=>'form-control pagenameInp'])?><a class="btn btn-success" href="#" id="addPage">Добавить страницу</a>
            <hr>
           <?php
                $pages = \common\models\PageToBlind::find()->where(['id_blind'=>$blind->id])->all();

                $ul = '';
                $k = 0;
                foreach($pages as $p){
                    if($k == 0){
                        $title = \common\models\PageBlinds::getNameTitleAdmin($p->id_pages);
                        $inp = $title;
                        $title = str_replace(' ','_',$title);
                        //$ul .= '<li class="active"><a href="#panel'.$title.'">'.$title.'</a><span page-id="'.$title.'" class="delPages">x</span></li>';
                        $ul .= '<li class="active"><a href="#panel'.$title.'"><input id-page="'.$title.'" type="text" class="insetName" value="'.$inp.'"/></a><span page-id="'.$title.'" class="delPages">x</span></li>';

                        $page = \common\models\PageItem::find()->where(['id_page'=>$p->id_pages])->all();
                        $html = '<div id="panel'.$title.'" class="tabPanel activeMy"><h3>'.$inp.'</h3>';
                        $html .= '<table id="t_'.$title.'" class="table table-bordered">';
                        foreach($page as $pg){
                            if($pg->item_type == 'materials') {
                                $html .= \common\classes\Supplies::getOneAddSupplies($pg->id_item,$title);
                                $inp .= '*'.$pg->id_item.'_materials';
                            }
                            else{
                                $zag = \common\models\PageForTitle::getName($pg->id_item);
                                $html .= '<tr class="itemPage" page-id="'.$title.'" materials-id="'.$zag.'" item-type="zagolovok"><td colspan="7">'.$zag.'</td><td><a class="delSuplies" href="#">Удалить</a></td></tr>';
                                $inp .= '*'.$zag.'_zagolovok';
                            }
                        }
                        $html .= '</table>
                        <a page-id="'.$title.'"data-toggle="modal" data-target="#myModal4" href="#" class="attachMaterialList">Прикрепить материалы списком</a> |
                            <a page-id="'.$title.'"data-toggle="modal" data-target="#myModal3" href="#" class="attachMaterial">Прикрепить материал</a> | <a class="attachZag" data-toggle="modal" data-target="#myModal2" href = "#" page-id="'.$title.'">Добавить заголовок</a>
                           <input id="input_'.$title.'" type="hidden" name="infoPage[]" value="'.$inp.'">
                        </div>';

                    }
                    else{
                        $title = \common\models\PageBlinds::getNameTitleAdmin($p->id_pages);
                        $inp = $title;
                        $title = str_replace(' ','_',$title);
                        $ul .= '<li><a href="#panel'.$title.'"><input id-page="'.$title.'" type="text" class="insetName" value="'.$inp.'"/></a><span page-id="'.$title.'" class="delPages">x</span></li>';


                        $page = \common\models\PageItem::find()->where(['id_page'=>$p->id_pages])->all();
                        $html .= '<div id="panel'.$title.'" class="tabPanel"><h3>'.$inp.'</h3>';
                        $html .= '<table id="t_'.$title.'" class="table table-bordered">';
                        foreach($page as $pg){
                            if($pg->item_type == 'materials') {
                                $html .= \common\classes\Supplies::getOneAddSupplies($pg->id_item,$title);
                                $inp .= '*'.$pg->id_item.'_materials';
                            }
                            else{
                                $zag = \common\models\PageForTitle::getName($pg->id_item);
                                $html .= '<tr class="itemPage" page-id="'.$title.'" materials-id="'.$zag.'" item-type="zagolovok"><td colspan="7">'.$zag.'</td><td><a class="delSuplies" href="#">Удалить</a></td></tr>';
                                $inp .= '*'.$zag.'_zagolovok';
                            }
                        }
                        $html .= '</table>
                            <a page-id="'.$title.'"data-toggle="modal" data-target="#myModal4" href="#" class="attachMaterialList">Прикрепить материалы списком</a> | <a page-id="'.$title.'"data-toggle="modal" data-target="#myModal3" href="#" class="attachMaterial">Прикрепить материал</a> | <a class="attachZag" data-toggle="modal" data-target="#myModal2" href = "#" page-id="'.$title.'">Добавить заголовок</a>
                             <input id="input_'.$title.'" type="hidden" name="infoPage[]" value="'.$inp.'">
                        </div>';
                    }
                    $k++;
                }
           ?>


            <div id="createdByPages">
                <ul id="myTab1" class="pageLink"><?=$ul;?></ul>
                <div class="pageTab" id="divTabContent"><?=$html;?></div>
            </div





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
                <div page-id="0" id="curentPageIdTitle"></div>
            <?/*= Html::dropDownList('forM', 0, $materials,['id'=>'selmat']) */?>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>-->
                <button id = "addTitle" type="button" class="btn btn-default">Добавить</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog matModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Прикрепить материал</h4>
            </div>
            <div class="modal-body">
                <div page-id="0" id="curentPageId"></div>
               <?php echo $addMat;?>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>-->
               <!-- <button id = "addTitle" type="button" class="btn btn-default">Добавить</button>-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog matModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Прикрепить материал списком</h4>
            </div>
            <div class="modal-body">
                <div page-id="0" id="curentPageIdListMat"></div>
                <textarea class = "articleMaterials" rows="10" cols="120"></textarea>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>-->
                <button id = "addArticleMaterials" type="button" class="btn btn-default">Добавить</button>
            </div>
        </div>
    </div>
</div>