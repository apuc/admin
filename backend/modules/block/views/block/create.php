<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\block\models\Block */

$this->title = 'Создать блок';
$this->params['breadcrumbs'][] = ['label' => 'Блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
