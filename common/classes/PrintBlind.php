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
        //получаем категорию и родительскую катоегорию
        $cat = Categories::find()->where(['id'=>$id])->one();
        $par_cat = Categories::find()->where(['id' => $cat->parent_id])->one();

        $html = '<h1>'.$par_cat->name.' на '.$cat->name.'</h1>';
        $html .= '<div class="pages" data-id="'.$id.'">';

        //генерируем страницу
        $html .= self::getPage($id,0);

        $html .= '</div>';
        return $html;
    }

    public static function getPage($id,$num){
        $cat = Categories::find()->where(['id'=>$id])->one();
        $count = $cat->count_product;

        $realNum = $num+1;
        $html = '';
        //достаем все жалюзи текущей категории
        $blinds = BlindCatid::find()->where(['id_cat' => $id])->offset($num*$count)->limit($count)->orderBy('id_blind DESC')->all();
        //получаем описание объекта жалюзи

        //start of page
        $html .= '<div class="page">';

        if($realNum > 1){
            $html .= '<div class="title">
                        <span>Страница '.$realNum.'  </span>
                        <a href="#" class="hidepage">Скрыть</a>
                    </div>';
        }

        foreach($blinds as $blind){
            if(isset($blind)){
                $blindObj = Blind::find()->where(['id' => $blind->id_blind])->one();
                //получаем картинки для жалюзи
                $blindImgs = BlindImg::find()->where(['id_blind' => $blindObj->id])->orderBy('main DESC')->all();
            }

            if(isset($blindObj) && !empty($blindObj)){
                $html .= self::getItem($blindObj,$blindImgs);
            }

        }

        //end of page
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