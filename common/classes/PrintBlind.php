<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25.08.2015
 * Time: 10:18
 */

namespace common\classes;


use backend\modules\blind\models\Blind;
use backend\modules\supplies\models\Supplies;
use common\models\BlindCatid;
use common\models\BlindIdmaterials;
use common\models\BlindImg;
use common\models\Categories;

class PrintBlind
{
    public static function getPosts($id){
        //$cat = Categories::find()->where(['parent_id'=>$id])->all();
        //получаем категорию и родительскую катоегорию
        $cat = Categories::find()->where(['id'=>$id])->one();
        $par_cat = Categories::find()->where(['id' => $cat->parent_id])->one();

        //достаем все жалюзи текущей категории
        $blinds = BlindCatid::find()->where(['id_cat' => $id])->all();
        //Debag::prn($blinds);

        $html = '<h1>'.$par_cat->name.' на '.$cat->name.'<h1>';
        $html .= '<div class="pages">';
        $c = 1;
        //Проходим по всем жалюзям
        for($i=0;$i<count($blinds);$i=$i+2){
            //счетчик страниц

            //получаем описание объекта жалюзи
            $blindObj1 = Blind::find()->where(['id' => $blinds[$i]->id_blind])->one();
            $blindObj2 = Blind::find()->where(['id' => $blinds[$i+1]->id_blind])->one();
            //получаем картинки для жалюзи
            $blindImgs1 = BlindImg::find()->where(['id_blind' => $blindObj1->id])->all();
            $blindImgs2 = BlindImg::find()->where(['id_blind' => $blindObj2->id])->all();

            //start of page
            $html .= '<div class="page">';

            if($c > 1){
                $html .= '<div class="title">
                            <span>Страница '.$c.'  </span>
                            <a href="#" class="hidepage">Скрыть</a>
                        </div>';
            }

            $html .= self::getItem($blindObj1,$blindImgs1);

            if(isset($blindObj2) && !empty($blindObj2)){
                $html .= self::getItem($blindObj2,$blindImgs2);
            }
            //end of page
            $html .= '</div>';
            $c++;
        }

        $html .= '</div>';
        return $html;
    }


    public static function getItem($obj,$img){
        //Debag::prn($obj->id);
        $count = self::getCount($obj->id);

        $html = '<div class="item">';
        $html .= self::getImg($img);
        $html .= '<div class="text">
                                <div class="title">'.$obj->name.'</div>
                                <p>'.$obj->description.'</p>
                                <div class="fulltext" style="display: none;">
                                    <p>'.$obj->description.'</p>
                                </div>
                                <a href="#" class="readmore">Читать полностью</a>
                            </div>
                            <div class="right">
                                <div class="price">
                                    Цена от <b><span>'.$count["min_price"].'</span> р/м2</b>
                                </div>
                                <a href="#" class="selectMy" data-target="'.$obj->id.'">Выбрать</a>
                                <div class="params">
                                    <span><img src="images/catalog_icon_color.png" alt=""><b>'.$count["colors"].'</b> цветов</span>
                                    <span><img src="images/catalog_icon_material.png" alt=""><b>'.$count["materials"].'</b> видов материала</span>
                                </div>
                            </div>
                        </div>';

        return $html;
    }

    public static function getImg($img){
        $html = '<div class="images">
                                <a href="#" class="large"><img class="large_page_img" src="'.$img[0]->images.'" alt=""></a>
                                <div class="thumbs">';

        for($i=0;$i<count($img);$i++){
            if(isset($img[$i])){
                $html .= '<a href="#" class="small"><img class="small_page_img" src="'.$img[$i]->images.'" alt=""></a>';
            }
        }

        $html .= '</div>
                            </div>';
        return $html;
    }

    public static function getCount($id){
        //$sup = Supplies::find()->where(['type_blind' => $id])->all();
        $supIds = BlindIdmaterials::find()->where(['id_blind' => $id])->all();

        $colors = [];
        $materials = [];
        $count = [];
        $prices = [];

        foreach ($supIds as $s) {
            $sup = Supplies::find()->where(['id' => $s->id_materials])->one();
            $colors[] = $sup->color;
            $materials[] = $sup->type_mat;
            $prices[] = $sup->price;
        }

        $colors = count(array_unique($colors));
        $materials = count(array_unique($materials));
        $prices = min($prices);


        $count['colors'] = $colors;
        $count['materials']= $materials;
        $count['min_price']= $prices;

       // Debag::prn($colors);

        return $count;

    }
}