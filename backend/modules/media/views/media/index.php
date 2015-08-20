<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Медиа файлы';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'mediaForm']]) ?>

<?= $form->field($model, 'file')->fileInput()->label('Загрузить файл') ?>

<button>Отправить</button>

<?php ActiveForm::end() ?>
<div class="mediaWrap">
    <h3>Существующие файлы:</h3>
<?php
foreach ($media as $m) {
    echo "
        <div class='mediaBox'>
            ".Html::img(\yii\helpers\Url::base()."/".$m->link, ['width'=>'150px'])."
            <br>
            ".Html::a('Удалить',['/media/delete', 'id' => $m->id])."
            <br>
            <input type='text' value='".\yii\helpers\Url::base(true)."/".$m->link."'>
        </div>";
}
?>
</div>
