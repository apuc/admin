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

<div class="title">
    <b>Вызов</b> <span>замерщика с образцами</span> бесплатный<br>
    Бесплатное <span>3D моделирование жалюзей</span> <b>на ваших окнах</b>
</div>
<a href="#" class="close"></a>
<a href="#" class="cause">Вызвать замерщика</a>
<div class="popup_content">
    <div class="prices">
        Цена: <span><b>1 999</b> руб/м²</span>
        <a href="#" class="left">
            <span>999</span> руб/м²
        </a>
        <a href="#" class="right">
            <span>2 999</span> руб/м²
        </a>
    </div>
    <div class="group">
        <div class="title">Жалюзи вертикальные тканевые</div>
        <div class="group_items">