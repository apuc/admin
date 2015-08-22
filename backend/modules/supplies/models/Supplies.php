<?php

namespace backend\modules\supplies\models;

use Yii;

/**
 * This is the model class for table "supplies".
 *
 * @property integer $id
 * @property string $images
 * @property integer $code
 * @property integer $type_mat
 * @property integer $type_blind
 * @property string $type_width
 * @property integer $color
 * @property string $price
 * @property integer $status
 */
class Supplies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['images', 'code', 'type_mat', 'type_blind', 'type_width', 'color', 'price', 'status'], 'required'],
            [['code', 'type_mat', 'type_blind', 'color', 'status'], 'integer'],
            [['images', 'type_width', 'price'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'images' => 'Изображение',
            'code' => 'Код образца',
            'type_mat' => 'Вид материала',
            'type_blind' => 'Вид жалюзей',
            'type_width' => 'Ширина',
            'color' => 'Расцветка',
            'price' => 'Цена',
            'status' => 'Статус',
        ];
    }
}
