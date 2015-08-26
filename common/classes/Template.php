<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 19.08.2015
 * Time: 11:40
 */

namespace common\classes;

use backend\modules\pages\Pages;
use common\models\Block;
use yii;
use common\classes\Debag;
use common\models\Tpl;

class Template
{


    public static function get_css($file)
    {
        $headFoot = Tpl::find()->all();
        $blocs = Block::find()->all();

        $pages = \backend\modules\pages\models\Pages::find()->all();
        $style = "";
        foreach ($pages as $p) {
            $style .= $p->style . "\n";
        }
        foreach ($headFoot as $hf) {
            $style .= $hf->style . "\n";
        }
        foreach ($blocs as $b) {
            $style .= $b->style . "\n";
        }
        $file = preg_replace("/{css}/", "<style>\n" . $style . "</style>", $file);
        return $file;
    }


    public static function get_header($model)
    {
        $header = Tpl::find()->where(['key' => 'header'])->one();
        $head = self::get_css($header->code);
        $head = self::get_title($model, $head);
        $head = self::get_keywords($model, $head);
        $head = self::get_description($model, $head);
        eval('?>' . $head . '<?php;');
    }

    public static function get_title($model, $file){
        return preg_replace("/{title}/", $model->title , $file);
    }

    public function get_keywords($model, $file){
        return preg_replace("/{keywords}/", "<meta name='keywords' content='$model->keywords'>" , $file);
    }

    public function get_description($model, $file){
        return preg_replace("/{description}/", "<meta name='description' content='$model->description'>" , $file);
    }

    public static function get_footer()
    {
        $footer = Tpl::find()->where(['key' => 'footer'])->one();
        eval('?>' . $footer->code . '<?php;');
    }

    public static function get_block($key)
    {
        $block = Block::find()->where(['key' => $key])->one();
        eval('?>' . $block->code . '<?php;');
    }

    public static function getBlockName($key)
    {
        if($key == 'ind'){
            return "Индивидуальный блок";
        }
        if($key == 'sub'){
            return "Блок подкатегорий";
        }
        if($key == 'des'){
            return "Блок Описание";
        }
        if($key == 'yes'){
            return "Готовый блок";
        }
    }

}