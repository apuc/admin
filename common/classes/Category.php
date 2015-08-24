<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 24.08.2015
 * Time: 16:12
 */

namespace common\classes;


use common\models\Categories;

class Category {
    public static function getCategories($id){
        $cat = Categories::find()->where(['parent_id'=>$id])->all();
        $html = '';
        foreach($cat as $c){
            
        }
    }
} 