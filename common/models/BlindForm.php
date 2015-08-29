<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class BlindForm extends Model
{
    public $name;
    public $status;
    public $categories;
    public $description;
    public $blind_image;
    public $materials;
    public $pagename;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['name', 'status','categories','description'], 'required'],
            [['blind_image','materials'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'status' => 'Статус',
            'description' => 'Описание',
            'categories' => 'Категории',
            'materials' => 'Материалы',
        ];
    }
}
