<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blind_materials".
 *
 * @property integer $id
 * @property integer $id_blind
 * @property integer $id_materials
 * @property string $title
 */
class BlindMaterials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blind_materials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_blind', 'id_materials', 'title'], 'required'],
            [['id_blind', 'id_materials'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_blind' => 'Id Blind',
            'id_materials' => 'Id Materials',
            'title' => 'Title',
        ];
    }

}
