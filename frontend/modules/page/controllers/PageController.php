<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 24.08.2015
 * Time: 8:39
 */

namespace frontend\modules\page\controllers;


use backend\modules\pages\models\Pages;
use common\classes\Debag;
use common\models\Request;
use yii\web\Controller;
use common\classes\Template;
use backend\modules\block\models\Block;
use backend\modules\options\models\Options;

class PageController extends Controller
{
    public function actionIndex(){

        //$page = Pages::find()->where(['id' => $_GET['p']])->one();
        $page = Pages::find()->where(['id' => $_GET['p']])->one();
        //$content = $this->getBlocks($page);

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
                $html .= "<div class='description'>$page->description</div>";
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

    public function actionGet_callme(){
        $tel = $_GET['tel'];

        $request = new Request();
        $request->telephone = (string)$tel;
        $request->dt_add = (string)time();

        $request->save();


        $email = Options::find()->where(['key'=>'email_to_prod'])->one();
        mail($email->value,"Заявка с вашего сайта","Заказ звонка на номер $tel","Content-type: text/html; charset=UTF-8\r\n");
    }
}