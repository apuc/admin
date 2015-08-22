<?php

namespace backend\modules\options\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value','name'], 'required'],
            [['key', 'value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name'=> 'Название опции',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }
}
