<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\block\models\Block */

$this->title = 'Редактирование блока: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
/*$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="block-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
