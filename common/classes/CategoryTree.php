<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 20.08.2015
 * Time: 12:38
 */

namespace common\classes;


use common\models\Categories;

class CategoryTree
{
    public static function getTree($parent_id, $level = 0)
    {
        $cat = Categories::find()->where(['parent_id' => $parent_id])->all();
        echo '<ul class ="menu_category" >';
        foreach ($cat as $c) {
            $tire = '-';
            if ($level != 0) {
                for ($i = 1; $i <= $level; $i++) {
                    $tire .= "-";
                }
            }

            echo '<li class = "list_category">' . $tire . $c->name . '<a href = "/secure/category/category/delete?id=' . $c->id . '">Удалить</a>';
            echo '<a href = "/secure/category/category/update?id=' . $c->id . '">Редактировать</a>';
            echo '<a href = "/secure/category/category/view?id=' . $c->id . '">Посмотреть</a>';
            $level++;
            self::getTree($c->id, $level);
            $level--;
            echo "</li>";
        }
        echo "</ul>";
    }

    public static function getTreeSelect($parent_id, $level = 0){
        $cat = Categories::find()->where(['parent_id' => $parent_id])->all();
        $arr[0] = 'Нет';
        foreach($cat as $c){
            $tire = '-';
            if ($level != 0) {
                for ($i = 1; $i <= $level; $i++) {
                    $tire .= "-";
                }
            }

            $arr[$c->id] = $tire.$c->name;
            $level++;
            $arr2 = self::getTreeSelect($c->id,$level);
            $arr = $arr + $arr2;
            $level--;
        }

        return $arr;
    }
} 