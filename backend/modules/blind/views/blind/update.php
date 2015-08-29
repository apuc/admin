<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\blind\models\Blind */

$this->title = 'Редактирование: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Жалюзи', 'url' => ['index']];
/*$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];*/
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="blind-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'catselect' => $catselect,
        'materials' => $materials,
        'materialselect' => $materialselect,
        'media' => $media,
        'img' => $img,
        'bmt' => $bmt,
        'blind' =>$blind,
        'addMat' =>$addMat,
    ]) ?>

</div>
