<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 25.08.2015
 * Time: 9:28
 */

namespace frontend\modules\category\controllers;


use backend\modules\blind\models\Blind;
use backend\modules\options\models\Options;
use common\classes\Category;
use common\classes\Debag;
use common\classes\PrintBlind;
use common\classes\Supplies;
use common\models\Orders;
use yii\web\Controller;
use backend\modules\block\models\Block;
use common\classes\Template;
use yii\filters\VerbFilter;

class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get_sup' => ['get'],
                    'get_order' => ['get'],
                    'get_page' => ['get'],
                    'get_count_items' => ['get'],
                ],
            ],
        ];
    }

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
            if($p[0] == 'i'){
                $blockId = explode('_', $p);
                $blockId = $blockId[1];
                $block = Block::find()->where(['id' => $blockId])->one();
                $html .= $block->code;
            }
            if($p == 'sub'){

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

    public function actionGet_sup(){
        //echo '123';
        if(isset($_GET['page_id'])){
            echo Supplies::getSupplies($_GET['id'],$_GET['page_id']);
        }
        else{
            echo Supplies::getSupplies($_GET['id']);
        }
    }

    public function actionGet_order(){
        $blind = Blind::find()->where(['id'=>$_GET['blId']])->one();
        $materials = \backend\modules\supplies\models\Supplies::find()->where(['id'=>$_GET['mtId']])->one();
        $telephone = $_GET['tel'];
        $order = new Orders();

        $order->blind = (string)$blind->name;
        $order->materials = (string)$materials->code;
        $order->telephone = (string)$telephone;
        $order->dt_add = time();

        $order->save();

        echo $order->id;

        $email = Options::find()->where(['key'=>'email_to_prod'])->one();

        mail($email->value, "Заказ с вашего сайта", "С вашего сайта заказали:<br>Номер заказа: $blind->id<br>Название жалюзи: $blind->name<br>Код материала: $materials->code<br>Телефон для связ: $telephone","Content-type: text/html; charset=UTF-8\r\n");
    }

    //аякс страницы
    public function actionGet_page(){
        echo PrintBlind::getPage($_GET['id'],$_GET['num']);
    }

    //аякс остаток страниц
    public function actionGet_count_items(){
        echo PrintBlind::getCountItems($_GET['id'],$_GET['num']);
    }
}