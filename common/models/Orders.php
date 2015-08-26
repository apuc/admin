<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $blind
 * @property string $materials
 * @property string $telephone
 * @property integer $dt_add
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blind', 'materials', 'telephone', 'dt_add'], 'required'],
            [['dt_add'], 'integer'],
            [['blind', 'materials', 'telephone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blind' => 'Blind',
            'materials' => 'Materials',
            'telephone' => 'Telephone',
            'dt_add' => 'Dt Add',
        ];
    }
}
