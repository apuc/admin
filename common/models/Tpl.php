<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tpl".
 *
 * @property integer $id
 * @property string $key
 * @property string $code
 * @property string $style
 */
class Tpl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tpl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'code'], 'required'],
            [['code', 'style'], 'string'],
            [['key'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'code' => 'Code',
            'style' => 'Style',
        ];
    }

    public static function test(){
        echo "123";
    }
}
