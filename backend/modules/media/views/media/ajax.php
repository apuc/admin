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