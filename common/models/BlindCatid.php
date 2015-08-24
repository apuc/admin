<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blind_catid".
 *
 * @property integer $id
 * @property integer $id_blind
 * @property integer $id_cat
 */
class BlindCatid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blind_catid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_blind', 'id_cat'], 'required'],
            [['id_blind', 'id_cat'], 'integer']
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
            'id_cat' => 'Id Cat',
        ];
    }
}
