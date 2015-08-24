<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $images
 * @property integer $count_product
 * @property string $hint
 * @property string $description
 * @property string $title
 * @property string $h1
 * @property string $keywords
 * @property string $code
 * @property string $style
 * @property string $sort
 * @property integer $blokc_id
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'count_product', 'hint', 'description', 'title', 'h1', 'keywords', 'blokc_id'], 'required'],
            [['parent_id', 'count_product', 'blokc_id'], 'integer'],
            [['description'], 'string'],
            [['code', 'style', 'sort'], 'safe'],
            [['name', 'images', 'hint', 'title', 'h1', 'keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Название',
            'images' => 'Изображение',
            'count_product' => 'Количество продуктов',
            'hint' => 'Подсказки',
            'description' => 'Описание',
            'title' => 'Title',
            'h1' => 'H1',
            'keywords' => 'Keywords',
            'blokc_id' => 'Blokc ID',
            'code' => 'Код',
            'style' => 'Стиль',
            'sort' => 'sort',
        ];
    }
}
