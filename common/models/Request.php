<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property string $telephone
 * @property integer $dt_add
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telephone', 'dt_add'], 'required'],
            [['dt_add'], 'integer'],
            [['telephone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'telephone' => 'Telephone',
            'dt_add' => 'Dt Add',
        ];
    }
}
