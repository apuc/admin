<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\blind\models\Blind */

$this->title = 'Create Blind';
$this->params['breadcrumbs'][] = ['label' => 'Blinds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blind-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'materials' => $materials,
        'media' => $media,
    ]) ?>

</div>
