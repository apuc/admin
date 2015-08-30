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
        echo '';
        foreach ($cat as $c) {
            $tire = '-';
            if ($level != 0) {
                for ($i = 1; $i <= $level; $i++) {
                    $tire .= "-";
                }
            }

            echo '<tr><td></td><td>' . $tire ."   ". $c->name . '</td><td><a href = "/secure/category/category/delete?id=' . $c->id . '"><img src="/securecrud_img/del.png" width="20" title="Удалить" alt="del.png"></a>';
            echo '<a href = "/secure/category/category/update?id=' . $c->id . '"><img src="/securecrud_img/edit.png" width="20" title="Редактировать" alt="edit.png"></a>';
            echo '<a class="targetBlanc" href = "/category?c=' . $c->id . '"><img src="/securecrud_img/view.png" width="20" title="Просмотр" alt="view.png"></a></td></tr>';
            $level++;
            self::getTree($c->id, $level);
            $level--;
            echo '';
        }
        echo '';
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