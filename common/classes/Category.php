<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 24.08.2015
 * Time: 16:12
 */

namespace common\classes;


use backend\modules\blind\models\Blind;
use common\models\BlindCatid;
use common\models\Categories;

class Category {
    public static function getCategories($id){
        $cat = Categories::find()->where(['parent_id'=>$id])->all();
        $cat_title = Categories::find()->where(['id'=>$id])->one();
        $html = '<div class="title">'.$cat_title->name.'</div>';
        $html .= '<div class="catalog_blocks">';
        foreach($cat as $c){

            $html .= '<div class="category">
                         <img src="'.$c->images.'" alt="" style = "width:350px" />
                         <div class="list_wrapper">
                         <div class="list">
                            <div class="title">'.$c->name.'<span></span></div>';
            $html .= self::getBlind($c->id);
             $html .=    '</div>';
            $html .= '<a href="#" class="showall">показать все</a>
                        <a href="#" class="more">подробнее</a>
                    </div>
                    </div>';
        }
        $html .= '</div>';
        return $html;
    }


    public static function getBlind($id){
        /*$html = '<div class="catalog_blocks">';*/
        $blinds = BlindCatid::find()->where(['id_cat'=>$id])->all();
        $html = '';
        foreach($blinds as $bl){
            $product = Blind::find()->where(['id'=>$bl->id_blind])->one();
            //Debag::prn($product);
            $html .='<div class="product">
                    <a href="#">'.$product->name.'</a>
                    <div class="info">
                        <span></span>
                        <div class="hint">
                           '.$product->description.'
                        </div>
                    </div>
                </div>';
        }
        /*$html .= '</div>';*/
        return $html;
    }
}

?>
