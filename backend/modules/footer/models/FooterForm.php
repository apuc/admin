<?php

namespace backend\modules\footer\models;

class FooterForm extends \yii\base\Model
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