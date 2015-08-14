<?php
namespace backend\modules\header\models;

class HeaderForm extends \yii\base\Model
{
    public $code;
    public $style;

    public function rules()
    {
        return [
            [['code', 'style'], 'required']
        ];
    }
}