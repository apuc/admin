<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 24.08.2015
 * Time: 8:39
 */

namespace frontend\modules\page\controllers;


use backend\modules\pages\models\Pages;
use yii\web\Controller;
use common\classes\Template;

class PageController extends Controller
{
    public function actionIndex(){

        //$page = Pages::find()->where(['id' => $_GET['p']])->one();
        $page = Pages::find()->where(['id' => $_GET['p']])->one();
        $content = $this->getBlocks($page);

        $con = $this->render('index', ['content' => $content, 'page' => $page]);

        Template::get_header($page);

        echo $con;

        Template::get_footer();
    }

    public function getBlocks($page){
        $sort = explode(',', $page->sort);
        $html = '';
        foreach($sort as $p){
            if($p == 'ind'){
                $html .= $page->code;
            }
            if($p == 'sub'){

            }
            if($p == 'des'){
                $html .= "<div class='description'>$page->description</div>";
            }
            if($p == 'yes'){
                $block = Block::find()->where(['id' => $page->blokc_id])->one();
                $html .= $block->code;
            }
        }
        return $html;
    }
}