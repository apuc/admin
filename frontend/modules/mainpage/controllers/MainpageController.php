<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 19.08.2015
 * Time: 11:09
 */

namespace frontend\modules\mainpage\controllers;


use backend\modules\options\models\Options;
use backend\modules\pages\models\Pages;
use common\classes\Debag;
use common\models\Block;
use yii\web\Controller;

class MainpageController extends Controller
{
    public function actionIndex(){
        $options = Options::find()->where(['key' => 'mainpage'])->one();
        $pageId = $options->value;
        $page = Pages::find()->where(['id' => $pageId])->one();
        $content = $this->getBlocks($page);

        return $this->render('index', ['content' => $content, 'page' => $page]);
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