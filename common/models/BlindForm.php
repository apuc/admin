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
    public $tab;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['name', 'status','categories','description'], 'required'],
            [['blind_image','materials','tab'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'status' => 'Активность товара',
            'description' => 'Описание',
            'categories' => 'Категории',
            'materials' => 'Материалы',
            'pagename' => 'Название страницы',
        ];
    }
}
