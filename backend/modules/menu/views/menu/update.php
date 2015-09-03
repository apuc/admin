<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\menu\models\Menu */

$this->title = 'Update Menu: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
/*$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'media' => $media
    ]) ?>

</div>
