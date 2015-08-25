<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 25.08.2015
 * Time: 9:28
 */

namespace frontend\modules\category\controllers;


use common\classes\Category;
use yii\web\Controller;
use backend\modules\block\models\Block;
use common\classes\Template;

class CategoryController extends Controller
{
    public function actionIndex(){

        //$page = Pages::find()->where(['id' => $_GET['p']])->one();
        $cat = \backend\modules\category\models\Category::find()->where(['id' => $_GET['c']])->one();
        //$content = $this->getBlocks($cat);

        //$con = $this->render('index', ['content' => $content, 'page' => $cat]);

        Template::get_header($cat);

        $this->getBlocks($cat);

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
        return eval('?>' . $html . '<?php;');;
    }
}