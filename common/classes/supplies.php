<?php
namespace common\classes;
use common\models\BlindIdmaterials;
use common\models\BlindMaterials;
use common\models\Color;
use common\models\Material;
use common\models\PageBlinds;
use common\models\PageForTitle;
use common\models\PageItem;
use common\models\PageToBlind;

class Supplies {
    public static function getSupplies($id,$idPage=0){
       if($idPage == 0){
           $page = PageToBlind::find()->where(['id_blind'=>$id])->one();
           $idPage = $page->id_pages;
       }
        $allPagess = PageToBlind::find()->where(['id_blind'=>$id])->all();
        /*Debag::prn($allPagess);*/
        $i = 0;
        $count = count($allPagess);
        foreach($allPagess as $ap){
            if($ap->id_pages == $idPage){
                $next = $allPagess[$i+1]->id_pages;
                if($i == 0){
                    $end = end($allPagess);
                    $end = $end->id_pages;
                }
                else{
                    if($i == $count-1){
                        $next = $allPagess[0]->id_pages;
                    }
                    $end = $allPagess[$i-1]->id_pages;
                }
            }
            $i++;
        }

        $html = '
                <div class="title">
                    <b>Вызов</b> <span>замерщика с образцами</span> бесплатный<br>
                    Бесплатное <span>3D моделирование жалюзей</span> <b>на ваших окнах</b>
                </div>
                    <a href="#" class="close"></a>
                    <a href="#" class="cause">Вызвать замерщика</a>
                <div class="popup_content">
                    <div class="prices">';

                     $html .= PageBlinds::getNameTitle($idPage);
                        if($count>1){
                            $html .= '<a href="#" id-page="'.$end.'" id-blind="'.$id.'" class="left pageChange">'.PageBlinds::getNameTitle($end).'</a>
                        <a href="#" id-page="'.$next.'" id-blind="'.$id.'" class="right pageChange">'.PageBlinds::getNameTitle($next).'</a>';
                        }
                    $html .= '</div>';
        //$supplies = BlindIdmaterials::find()->where(['id_blind'=>$id])->all();
        $supplies = PageItem::find()->where(['id_page'=>$idPage])->all();
        /*$blm = BlindMaterials::find()->where(['id_blind'=>$id])->all();
        foreach($blm as $b){
            $arrBlmID[] = $b->id_materials;
        }*/
        $k = 1;
        $j=0;
        foreach($supplies as $v){
            //$supl = \backend\modules\supplies\models\Supplies::find()->where(['id'=>$v->id_materials])->one();
            if($v->item_type == 'zagolovok'){
                $zag = PageForTitle::getName($v->id_item);
                if($j != 0){
                    $html .= "</div></div></div>";
                }
                else {
                    $j=1;
                }
                $html .= '<div class="group">
                            <div class="title">'.$zag.'</div>
                            <div class="group_items">';
                $k = 1;
                continue;
                //echo self::getTitle($id,$v->id_materials).'<br>';
            }

            $supl = \backend\modules\supplies\models\Supplies::find()->where(['id'=>$v->id_item])->one();
            if($k == 1){$html .= '<div class="line">';}
            $html .= '<div class="item">
                        <a href="#"><img src="'.$supl->images.'" alt="" width="163px"/></a>
                        <span>Код: '.$supl->code.'</span>
                        <a href="#" class="order" blind-id="'.$id.'" suuples-id="'.$v->id_item.'">Заказать</a>
                    </div>';
            if($k == 5){$html .= '</div>';$k = 1;}
            if($v->item_type == 'zagolovok'){
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

    public static function getAddSupplies(){
        $suplies = \backend\modules\supplies\models\Supplies::find()->all();
        $html = '<table class="table table-bordered">
                <tr>
                    <th>Изображение</th>
                    <th>Код</th>
                    <th>Вид материала</th>
                    <th>Вид</th>
                    <th>Ширина</th>
                    <th>Цвет</th>
                    <th>Цена</th>
                    <th></th>
                </tr>';
        foreach($suplies as $supl){
            $html .= '<tr>';
            $html .= '<td><img src="'.$supl->images.'" style = "width:100px;"/></td>';
            $html .= '<td>'.$supl->code.'</td>';

            $type_materials = Material::find()->where(['id'=>$supl->type_mat])->one();

            $html .= '<td>'.$type_materials->name.'</td>';

            if($supl->type_blind == 1){
                $html .= '<td>Горизонтальные</td>';
            }
            if($supl->type_blind == 2){
                $html .= '<td>Вертикальные</td>';
            }
            if($supl->type_blind == 3){
                $html .= '<td>Рулонные</td>';
            }

            $html .= '<td>'.$supl->type_width.'</td>';

            $color = Color::find()->where(['id'=>$supl->color])->one();

            $html .= '<td><div class="colorSuplies" style="width:50px;height:25px;background: '.$color->value.'"></div></td>';

            $html .= '<td>'.$supl->price.'</td>';
            $html .= '<td><a id-materials="'.$supl->id.'"class = "addSuplies" href="#">Прикрепить</a></td>';
            $html .= '</tr>';
        }
        $html .= "</table>";
        return $html;
    }

    public static function getOneAddSupplies($id,$title){
        $supl = \backend\modules\supplies\models\Supplies::find()->where(['id'=>$id])->one();

        $html = '';
            $html .= '<tr class="itemPage" page-id="'.$title.'" materials-id="'.$supl->id.'" item-type="materials">';
            $html .= '<td><img src="'.$supl->images.'" style = "width:100px;"/></td>';
            $html .= '<td>'.$supl->code.'</td>';

            $type_materials = Material::find()->where(['id'=>$supl->type_mat])->one();

            $html .= '<td>'.$type_materials->name.'</td>';

            if($supl->type_blind == 1){
                $html .= '<td>Горизонтальные</td>';
            }
            if($supl->type_blind == 2){
                $html .= '<td>Вертикальные</td>';
            }
            if($supl->type_blind == 3){
                $html .= '<td>Рулонные</td>';
            }

            $html .= '<td>'.$supl->type_width.'</td>';

            $color = Color::find()->where(['id'=>$supl->color])->one();

            $html .= '<td><div class="colorSuplies" style="width:50px;height:25px;background: '.$color->value.'"></div></td>';

            $html .= '<td>'.$supl->price.'</td>';
            $html .= '<td><a id-materials="'.$supl->id.'"class = "delSuplies" href="#">Открепить</a></td>';
            $html .= '</tr>';
        return $html;
    }
}


