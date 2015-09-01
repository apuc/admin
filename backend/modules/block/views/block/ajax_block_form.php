<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 01.09.2015
 * Time: 9:38
 */
use yii\helpers\Html;

echo '<div class="indBlockContainer">';

echo Html::textarea('code',$model->code,['class' => 'blockAreaCode','rows' => 6, 'cols' => 150]);

echo Html::textarea('style',$model->style,['class' => 'blockAreaStyle','rows' => 6, 'cols' => 150]);

echo Html::button('Сохранить',['class'=>'saveBtn','data-block-id' => $model->id]);

echo Html::button('Отмена',['class'=>'cancelBtn','data-block-id' => $model->id]);

echo '</div>';

