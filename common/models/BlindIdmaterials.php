<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blind_idmaterials".
 *
 * @property integer $id
 * @property integer $id_blind
 * @property integer $id_materials
 */
class BlindIdmaterials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blind_idmaterials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_blind', 'id_materials'], 'required'],
            [['id_materials'], 'integer'],
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
        ];
    }
}
