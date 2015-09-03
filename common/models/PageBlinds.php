<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page_blinds".
 *
 * @property integer $id
 * @property string $name
 */
class PageBlinds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_blinds';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }


    public static function getNameTitle($id){
        $title = PageBlinds::find()->where(['id'=>$id])->one();
        return str_replace("№", "/", $title->name);
    }
}
