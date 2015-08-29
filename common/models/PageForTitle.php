<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page_for_title".
 *
 * @property integer $id
 * @property string $title
 */
class PageForTitle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_for_title';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
            'title' => 'Title',
        ];
    }

    public static function getName($id){
        $title = PageForTitle::find()->where(['id'=>$id])->one();
        return $title->title;
    }
}
