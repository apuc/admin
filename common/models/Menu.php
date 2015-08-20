<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $url
 * @property string $icon
 * @property string $descr
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'descr'], 'required'],
            [['parent_id'], 'integer'],
            [['descr'], 'string'],
            [['name', 'url', 'icon'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Название',
            'url' => 'Url',
            'icon' => 'Icon',
            'descr' => 'Описание',
        ];
    }
}
