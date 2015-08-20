<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 19.08.2015
 * Time: 11:40
 */

namespace common\classes;

use common\models\Block;
use yii;
use common\classes\Debag;
use common\models\Tpl;

class Template
{


    public static function get_css($file){
        $headFoot = Tpl::find()->all();
        $blocs = Block::find()->all();
        $style = "";
        foreach($headFoot as $hf){
            $style .= $hf->style."\n";
        }
        foreach($blocs as $b){
            $style .= $b->style."\n";
        }
        $file = preg_replace("/{css}/", "<style>\n".$style."</style>", $file);
        return $file;
    }

    public static function get_header(){
        $header = Tpl::find()->where(['key' => 'header'])->one();
        $head = self::get_css($header->code);
        eval('?>'.$head.'<?php;');
    }

    public static function get_footer(){
        $footer = Tpl::find()->where(['key' => 'footer'])->one();
        eval('?>'.$footer->code.'<?php;');
    }

    public static function get_block($key){
        $block = Block::find()->where(['key' => $key])->one();
        eval('?>'.$block->code.'<?php;');
    }

}