<?php

namespace backend\modules\blind\models;

use Yii;

/**
 * This is the model class for table "blind".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $description
 * @property string $tab
 */
class Blind extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blind';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'description'], 'required'],
            [['status'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['tab'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'status' => 'Активность товара',
            'description' => 'Описание',
            'pagename' => 'Название страницы',
        ];
    }
}
