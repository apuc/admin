<?php

namespace common\classes;
use common\classes\Supplies;
class Debag
{
    public static function prn($content)
    {
        echo '<pre style="background: lightgray; border: 1px solid black; padding: 2px">';
        print_r($content);
        echo '</pre>';
    }
}