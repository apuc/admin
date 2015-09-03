<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Menu;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\menu\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню';
$this->params['breadcrumbs'][] = $this->title; ?>

<?= Html::a('Создать элемент', ['create'], ['class' => 'btn btn-success']) ?>

<?php

function printMenuTree($parent_id){
    $menu = Menu::find()->where(['parent_id' => $parent_id])->orderBy('sort')->all();
    foreach($menu as $m){
        echo "<li class='sortitem' data-id='$m->id' data-parent-id='$m->parent_id'><span class='sortMenuLink'>$m->name</span>";
        echo "<ul id='sortable' class='ui-sortable'>";
        printMenuTree($m->id);
        echo "<li class='empty'><a class='editMenu' data-menu-id='$m->id' class='sortMenuLink' href='#'>Редактировать</a> | <a class='sortMenuLink' href='/secure/menu/menu/delete?id=$m->id'>Удалить</a></li></ul>";
        echo "</li>";
    }
}

echo "<ul id='sortable' class='mainSort' data-id='0' data-parent-id='0'>";
printMenuTree(0);
echo "</ul>";

?>
<!--
<div class="menu-index">

    <h1><?/*= Html::encode($this->title) */?></h1>
    <?php /*// echo $this->render('_search', ['model' => $searchModel]); */?>

    <p>
        <?/*= Html::a('Create Menu', ['create'], ['class' => 'btn btn-success']) */?>
    </p>

    <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parent_id',
            'name',
            'url:url',
            'icon',
            // 'descr:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>

</div>-->
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