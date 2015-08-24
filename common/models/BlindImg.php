<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blind_img".
 *
 * @property integer $id
 * @property integer $id_blind
 * @property string $images
 */
class BlindImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blind_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_blind', 'images'], 'required'],
            [['id_blind'], 'integer'],
            [['images'], 'string', 'max' => 255]
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
            'images' => 'Images',
        ];
    }
}
