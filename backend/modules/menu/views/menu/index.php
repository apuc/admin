<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Menu;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\menu\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title; ?>

<?= Html::a('Создать элемент', ['create'], ['class' => 'btn btn-success']) ?>

<?php

function printMenuTree($parent_id){
    $menu = Menu::find()->where(['parent_id' => $parent_id])->orderBy('sort')->all();
    foreach($menu as $m){
        echo "<li class='sortitem' data-id='$m->id' data-parent-id='$m->parent_id'><span class='sortMenuLink'>$m->name</span>";
        echo "<ul id='sortable' class='ui-sortable'>";
        printMenuTree($m->id);
        echo "<li class='empty'><a class='sortMenuLink' href='/secure/menu/menu/update?id=$m->id'>Редактировать</a> | <a class='sortMenuLink' href='/secure/menu/menu/delete?id=$m->id'>Удалить</a></li></ul>";
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
