<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\supplies\models\SuppliesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Материалы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать материал', ['add'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            [
                'attribute'=>'image',
                'format' => 'raw',
                'value' => function($model){
                    return "<a href='#' class='openModalSup' data-sup-id='$model->id' data-toggle='modal' data-target='#myModal'><img class='supImg' id='supImg_$model->id' src='$model->images' width='100px'></a>";
                }
            ],
            [
                'attribute'=>'code',
                'class' => DataColumn::className(),
                'format' => 'raw',
                'value' => function($model){
                    return Html::textInput('code_' . $model->id, $model->code, ['id' => 'code_' . $model->id, 'class' => 'codeInput']);
                    //return "<input type='text' value='$model->code' name='code'>";
                }
            ],
            [
                'attribute'=>'type_mat',
                'format' => 'raw',
                'value' => function($model){
                    $mat = \backend\modules\material\models\Material::find()->all();
                    foreach($mat as $m){
                        $arr[$m->id] = $m->name;
                    }
                    return Html::dropDownList('mat_' . $model->id, $model->type_mat, $arr, ['id' => 'mat_' . $model->id, 'class' => 'matSelect']);
                    //$material = \common\models\Material::find()->where(['id' => $model->type_mat])->one();
                    //return $material->name;
                },
                'filter' => Html::activeDropDownList(new \backend\modules\supplies\models\SuppliesSearch(), 'type_mat', \yii\helpers\ArrayHelper::map(\backend\modules\material\models\Material::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Выберите тип материала','options' => [$_GET['SuppliesSearch']['type_mat'] => ['selected '=>'selected']]]),
            ],
            [
                'attribute'=>'type_blind',
                'format' => 'raw',
                'value' => function($model){
                    /*if($model->type_blind == '1'){
                        return 'Горизантальные';
                    }
                    if($model->type_blind == '2'){
                        return 'рулонные';
                    }
                    if($model->type_blind == '3'){
                        return 'вертикальные';
                    }*/

                    $arr = ['0' => 'Выберите элемент', '1' => 'Горизантальные', '2' => 'рулонные', '3' => 'вертикальные'];
                    return Html::dropDownList('blind_' . $model->id, $model->type_blind, $arr, ['id' => 'blind_' . $model->id, 'class' => 'blindSelect']);

                },
                'filter' => Html::dropDownList('SuppliesSearch[type_blind]',$_GET['SuppliesSearch']['type_blind'],[''=>'Выберите','1' => 'Горизантальные', '2' => 'рулонные', '3' => 'вертикальные'], ['id'=>'suppliessearch-type_blind']),
            ],

            [
                'attribute'=>'type_width',
                'format' => 'raw',
                'value' => function($model){
                    return Html::textInput('width_' . $model->id, $model->type_width, ['id' => 'width_' . $model->id, 'class' => 'widthInput']);
                    //return "<input type='text' value='$model->code' name='code'>";
                }
            ],
            [
                'attribute'=>'color',
                'format' => 'raw',
                'value' => function($model){
                    $allColor = \common\models\Color::find()->all();
                    $color = \common\models\Color::find()->where(['id'=>$model->color])->one();
                    $html = Html::hiddenInput('color_' . $model->id, $model->color, ['id' => 'color_' . $model->id, 'class' => 'colorInput']);
                    $html .= '<div class="selectColor" style = "width:100px;height:20px;background-color: '.$color->value.'"></div>';
                    $html .= "<div class='allColor'>";
                    foreach($allColor as $c){
                        $html .= "<div class='selectOnecolor' color='$c->value' data-sup-id='$model->id' data-id='$c->id' style='background-color:$c->value;width: 100px;height: 20px;margin: 5px'></div>";
                    }
                    $html .= "</div>";
                    return $html;
                },
                'filter' => Html::activeDropDownList(new \backend\modules\supplies\models\SuppliesSearch(), 'color', \yii\helpers\ArrayHelper::map(\backend\modules\color\models\Color::find()->asArray()->all(), 'id', 'value'),['class'=>'form-control','prompt' => 'Выберите цвет','options' => [$_GET['SuppliesSearch']['color'] => ['selected '=>'selected']]]),

            ],
            [
                'attribute'=>'price',
                'format' => 'raw',
                'value' => function($model){
                    return Html::textInput('price_' . $model->id, $model->price, ['id' => 'price_' . $model->id, 'class' => 'priceInput']);
                    //return "<input type='text' value='$model->code' name='code'>";
                }
            ],

            [
                'class' => DataColumn::className(),
                'header'=> 'Прикреплен',
                'format' =>'raw',
                'value' => function($model){
                    $pageItem = \common\models\PageItem::find()->where(['id_item'=>$model->id,'item_type'=>'materials'])->all();
                    foreach($pageItem as $p){
                        $arr[] = $p->id_blind;
                    }
                    if(!empty($arr)){
                        $arr = array_unique($arr);
                        $html = '';
                        $html .= '<div class="blindToSupliesOne">';
                        $k = 0;

                        foreach($arr as $p){
                            if($p){
                                $title = \backend\modules\blind\models\Blind::find()->where(['id'=>$p])->one();
                                if($k == 2){
                                    $html .= '</div><div class="blindToSuplies">';
                                }

                                $html .= '<li>' . $title->name . '<a href="#" class="undock" id-mat="' . $model->id . '" id-page="' . $p . '"> -</a></li>';
                                $k++;
                            }
                        }
                        $html .= '</div>';
                        if($k > 2){$html .= '<a href="#" class="allBlindToSuplies">Показать все</a>';}
                        return $html;
                    }
                    else {
                      return '';
                    }

                }
            ],
            // 'status',

            [
                'class'  => DataColumn::className(),
                'header' => 'Действия',
                'format' => 'html',
                'value' => function($model){
                   /* $view = Html::a("<img src='".\yii\helpers\Url::base()."crud_img/view.png' width='20px' title='Просмотр'></a>", ['/supplies/supplies/view','id'=>$model->id]);
                    $view .= Html::a("<img src='".\yii\helpers\Url::base()."crud_img/edit.png' width='20px' title='Редактировать'></a>", ['/supplies/supplies/update','id'=>$model->id]);*/
                    $view = Html::a("<img src='".\yii\helpers\Url::base()."crud_img/del.png' width='20px' title='Удалить'></a>", ['/supplies/supplies/delete','id'=>$model->id]);
                    return $view;
                }
            ],
        ],
    ]); ?>
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
                        <div data-id="0" id="selectImgId"></div>
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
</div>
