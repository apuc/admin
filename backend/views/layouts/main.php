<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav role='navigation'>
        <ul>
            <!--<li><?/*= Html::a('Главная', ['/pages/pages/update?id=1']) */?></li>-->
            <li><a href="#">Внешний вид</a>
                <ul>
                    <li><?= Html::a('Меню', ['/menu']) ?></li>
                    <li><?= Html::a('Header', ['/header']) ?></li>
                    <li><?= Html::a('Footer', ['/footer']) ?></li>
                    <li><?= Html::a('Блоки', ['/block']) ?></li>
                    <li><?= Html::a('Медиа файлы', ['/media']) ?></li>
                </ul>
            </li><li><a href="#">Контент</a>
                <ul>
                    <!--<li><?/*= Html::a('Главная', ['/pages/pages/update?id=1']) */?></li>-->
                    <li><?= Html::a('Разделы', ['/category']) ?></li>
                    <li><?= Html::a('Страницы', ['/pages']) ?></li>
                    <li><?= Html::a('Материалы', ['/supplies']) ?></li>
                    <li><?= Html::a('Жалюзи', ['/blind']) ?></li>
                </ul>
            </li>
            <li><a href="#">Настройки</a>
                <ul>
                    <li><?= Html::a('Виды материалов', ['/material']) ?></li>
                    <li><?= Html::a('Цвет', ['/color']) ?></li>
                    <!--<li><?/*= Html::a('Email для заказов', ['/options/options/update?id=2']) */?></li>-->
                    <li><?= Html::a('Опции', ['/options']) ?></li>
                    <li><?= Html::a('Профиль', ['/user/user/update?id=2']) ?></li>
                </ul>
            </li>
            <li><?= Html::a('Заказы', ['/orders']) ?></li>
            <li><?= Html::a('Заявки', ['/request']) ?></li>
            <li><?= Html::a('Выход', ['/site/logout']) ?></li>
        </ul>
    </nav>
    <?php
/*    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    */?>



    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
