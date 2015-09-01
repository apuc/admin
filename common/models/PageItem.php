<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page_item".
 *
 * @property integer $id
 * @property integer $id_page
 * @property integer $id_item
 * @property string $item_type
 */
class PageItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_page', 'id_item', 'item_type'], 'required'],
            [['id_page', 'id_item'], 'integer'],
            [['item_type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_page' => 'Id Page',
            'id_item' => 'Id Item',
            'item_type' => 'Item Type',
            'id_blind'=> 'id Blind'
        ];
    }
}
