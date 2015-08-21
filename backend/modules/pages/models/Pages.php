<?php

namespace backend\modules\pages\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $name
 * @property string $images
 * @property integer $count_product
 * @property string $hint
 * @property string $description
 * @property string $title
 * @property string $h1
 * @property string $keywords
 * @property integer $blokc_id
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'count_product', 'hint', 'description', 'title', 'h1', 'keywords', 'blokc_id'], 'required'],
            [['count_product', 'blokc_id'], 'integer'],
            [['description'], 'string'],
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
            'name' => 'Название',
            'images' => 'Изображение',
            'count_product' => 'Количество продуктов',
            'hint' => 'Подсказки',
            'description' => 'Описание',
            'title' => 'Title',
            'h1' => 'H1',
            'keywords' => 'Keywords',
            'blokc_id' => 'Blokc ID',
        ];
    }
}
