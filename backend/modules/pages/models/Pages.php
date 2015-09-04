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
 * @property string $code
 * @property string $style
 * @property string $sort
 * @property string $sort_all
 * @property string $tab
 * @property integer $blokc_id
 * @property integer $fix_menu
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
            [['name', 'description', 'title', 'h1', 'keywords', 'blokc_id'], 'required'],
            [['count_product', 'blokc_id'], 'integer'],
            [['description'], 'string'],
            [['code', 'style', 'sort', 'count_product', 'hint', 'sort_all', 'tab','fix_menu'], 'safe'],
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
            'code' => 'Код',
            'style' => 'Стиль',
            'sort' => 'sort',
            'fix_menu' => 'Прикрепить меню',
        ];
    }
}
