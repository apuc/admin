<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 19.08.2015
 * Time: 11:10
 */

namespace common\classes;

use yii;

class Header
{

    public static function get_header(){
        echo file_get_contents(Yii::$app->urlManager->createAbsoluteUrl('backend/web/html/header.php'));
    }

}