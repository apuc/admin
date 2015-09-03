<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "block".
 *
 * @property integer $id
 * @property string $key
 * @property string $name
 * @property string $code
 * @property string $style
 * @property string $img
 * @property string $type
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['key', 'style', 'img', 'type'], 'safe'],
            [['key', 'name', 'img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Ключ',
            'name' => 'Название блока',
            'code' => 'Код блока',
            'style' => 'Стили блока',
            'img' => 'Картинка',
            'type' => 'Тип',
        ];
    }
}
