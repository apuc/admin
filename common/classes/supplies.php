<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 25.08.2015
 * Time: 10:36
 */

namespace common\classes;


use common\models\BlindIdmaterials;

class Supplies {
    public static function getSupplies($id){
        $supplies = BlindIdmaterials::find()->where(['id_blind'=>$id])->all();
        $html = '<div class="line">';
        foreach($supplies as $v){
            $supl = \backend\modules\supplies\models\Supplies::find()->where(['id'=>$v->id_materials])->one();
            $html .= ' <div class="item">
                        <a href="#"><img src="'.$supl->images.'" alt="" width="163px" /></a>
                        <span>Код: '.$supl->code.'</span>
                        <a href="#" class="order">Заказать</a>
                    </div>';
        }
        $html .= "</div>";
        return $html;
    }
}
?>