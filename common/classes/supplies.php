<?php
namespace common\classes;
use common\models\BlindIdmaterials;
use common\models\BlindMaterials;

class Supplies {
    public static function getSupplies($id){
        $html = '
                <div class="title">
                    <b>Вызов</b> <span>замерщика с образцами</span> бесплатный<br>
                    Бесплатное <span>3D моделирование жалюзей</span> <b>на ваших окнах</b>
                </div>
                    <a href="#" class="close"></a>
                    <a href="#" class="cause">Вызвать замерщика</a>
                <div class="popup_content">
                    <div class="prices">
                        Цена: <span><b>1 999</b> руб/м²</span>
                        <a href="#" class="left"><span>999</span> руб/м²</a>
                        <a href="#" class="right"><span>2 999</span> руб/м²</a>
                    </div>';
        $supplies = BlindIdmaterials::find()->where(['id_blind'=>$id])->all();
        $blm = BlindMaterials::find()->where(['id_blind'=>$id])->all();
        foreach($blm as $b){
            $arrBlmID[] = $b->id_materials;
        }
        $k = 1;
        $j=0;
        foreach($supplies as $v){
            $supl = \backend\modules\supplies\models\Supplies::find()->where(['id'=>$v->id_blind])->one();
           // Debag::prn($supl);
            if(in_array($v->id_materials,$arrBlmID)){
                if($j != 0){
                    $html .= "</div></div></div>";
                }
                else {
                    $j=1;
                }
                $html .= '<div class="group">
                            <div class="title">'.self::getTitle($id,$v->id_materials).'</div>
                            <div class="group_items">';
                $k = 1;

                //echo self::getTitle($id,$v->id_materials).'<br>';
            }

            if($k == 1){$html .= '<div class="line">';}
            $html .= '<div class="item">
                        <a href="#"><img src="'.$supl->images.'" alt="" width="163px"/></a>
                        <span>Код: '.$supl->code.'</span>
                        <a href="#" class="order">Заказать</a>
                    </div>';
            if($k == 5){$html .= '</div>';$k = 1;}
            if(in_array($v->id_materials,$arrBlmID )){
                $html .= '';

                //echo self::getTitle($id,$v->id_materials).'<br>';
            }
            $k++;
        }
        $html .= '</div></div></div></div>';
        return $html;
    }

    public static function getTitle($idBlind,$idMaterials){
        $obg = BlindMaterials::find()->where(['id_blind'=>$idBlind,'id_materials'=>$idMaterials])->one();
        return $obg->title;
    }
}


