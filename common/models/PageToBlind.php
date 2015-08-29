<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page_to_blind".
 *
 * @property integer $id
 * @property integer $id_blind
 * @property integer $id_pages
 */
class PageToBlind extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_to_blind';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_blind', 'id_pages'], 'required'],
            [['id_blind', 'id_pages'], 'integer']
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
            'id_pages' => 'Id Pages',
        ];
    }
}
