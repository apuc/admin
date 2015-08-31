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
use common\classes\Template;
use common\models\Block;
use yii\web\Controller;

class MainpageController extends Controller
{
    public function actionIndex(){
        $options = Options::find()->where(['key' => 'mainpage'])->one();
        $pageId = $options->value;
        $page = Pages::find()->where(['id' => $pageId])->one();
        //$content = $this->getBlocks($page);

        //$con = $this->render('index', ['content' => $content, 'page' => $page]);

        Template::get_header($page);

        $this->getBlocks($page);

        Template::get_footer();
    }

    public function getBlocks($page){
        $sort = explode(',', $page->sort);
        $html = '';
        foreach($sort as $p){
            if($p[0] == 'i'){
                $blockId = explode('_', $p);
                $blockId = $blockId[1];
                $block = Block::find()->where(['id' => $blockId])->one();
                $html .= $block->code;
            }
            if($p == 'sub'){

            }
            if($p == 'des'){
                /*$html .= "<div class='description'>$page->description</div>";*/
            }
            if($p[0] == 'y'){
                $blockId = explode('_', $p);
                $blockId = $blockId[1];
                $block = Block::find()->where(['id' => $blockId])->one();
                $html .= $block->code;
            }
        }
        return eval('?>' . $html . '<?php;');;
    }
}