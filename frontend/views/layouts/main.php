<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\classes\Template;

AppAsset::register($this);
?>


<?php
Template::get_header();
?>

<?= Alert::widget() ?>
<?= $content ?>

<?php
Template::get_footer();
?>
<?php /*$this->endBody() */?>

<?php /*$this->endPage() */?>
