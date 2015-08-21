<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 20.08.2015
 * Time: 12:38
 */

namespace common\classes;


use common\models\Categories;

class CategoryTree {
    public static function getTree($parent_id){
        $cat = Categories::find()->where(['parent_id' => $parent_id])->all();
        echo '<ul class ="menu_category" >';
        foreach($cat as $c){
            echo '<li class = "list_category">'.$c->name.'<a href = "/secure/category/category/delete?id='.$c->id.'">Удалить</a>';
            echo '<a href = "/secure/category/category/update?id='.$c->id.'">Редактировать</a>';
            echo '<a href = "/secure/category/category/view?id='.$c->id.'">Посмотреть</a>';

            self::getTree($c->id);
            echo "</li>";
        }
        echo "</ul>";
    }
} 