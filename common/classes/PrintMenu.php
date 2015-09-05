<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24.08.2015
 * Time: 11:28
 */

namespace common\classes;


use common\models\Categories;

class PrintMenu
{
    public $html = '';
    public $menuModel;
    public $menus = array();
    public $i,$j =0;

    public function generateHtml($model){
        foreach($model as $tab){
            $this->menus[$tab->parent_id][] = $tab;
        }

        //Debag::prn($this->menus);
        $this->html = '<nav class="mainmenu">
            <ul>';

        $this->outTree(0, 0);

        $this->html .= '</ul>
        </nav>';

        //Debag::prn($this->html);
        return $this->html;
    }

    public function outTree($parent_id, $level) {
        if (isset($this->menus[$parent_id])) { //���� ��������� � ����� parent_id ����������
            foreach ($this->menus[$parent_id] as $value) { //�������
                //$this->html .= '<li style="margin-left:'. $level*25 .'px;"><a href="'.$value["url"].'">'.$value["name"].'</a>';

                $level = $level + 1; //����������� ������� ����������
               // $this->html .= '<li>';

                //���������� �������� ��� �� �������, �� � ����� $parent_id � $level
                //style="margin-left:'. $level*25 .'px;"

                if ($level == 1) {
                    $this->html .= '<li><a href="'.$value["url"].'">'.$value["name"].'</a><nav class="2ndmenu"><ul>';
                } elseif ($level == 2) {
                    $this->html .= '<li><a href="'.$value["url"].'">'.$value["name"].'</a>';
                } elseif($level == 3){
                    if($this->i == 0){
                        $this->html .= '<ul class="3rdmenu">';
                        $this->i = 1;
                    }

                    $this->html .= '<li><a href="'.$value["url"].'"><img src="'.$value["icon"].'" alt=""></a>
                    <a href="'.$value["url"].'" class="title">'.$value["name"].'</a>
                    <p>'.$value["descr"].'</p>';
                }

                $this->outTree($value["id"], $level);

                $level = $level - 1; //��������� ������� ����������
               // $this->html .= $level;
                if ($level == 0) {
                    $this->html .= '</ul></nav>';
                    //$this->i = 1;
                } elseif ($level == 1) {
                    if($this->i == 1){
                        $this->html .= '</ul>';
                        $this->i = 0;
                    }
                    //$this->j = 1;
                }

                $this->html .= '</li>';
            }
        }
    }
}