<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use macgyer\yii2materializecss\widgets\NavBar;
use macgyer\yii2materializecss\widgets\Nav;
use macgyer\yii2materializecss\widgets\Button;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin(['brandLabel' => 'Система дистанционного обучения',
//                   'fixed' => true,
//                   'fixed' => true,
        ]);
//    echo Nav::widget([
//        'items' => [
//            ['label' => 'Вход', 'url' => ['/site/login']],
//            ['label' => 'Регистрация', 'url' => ['/site/register']],
//        ],
//    ]);
    NavBar::end();
    ?>
    <?php
        NavBar::begin([]);
        echo Nav::widget([
                'class' => 'right',
           'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Теория', 'url' => ['/site/theory']],
                ['label' => 'Обучение', 'url' => ['/site/training']],
                ['label' => 'Проверка знаний', 'url' => ['/site/testing']],
            ],
        ]);
        NavBar::end();
    ?>



<!--    <nav class="light-blue lighten-1" role="navigation">-->
<!--        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>-->
<!--            <ul class="right hide-on-med-and-down">-->
<!--                <li><a href="#">Navbar Link</a></li>-->
<!--            </ul>-->
<!---->
<!--            <ul id="nav-mobile" class="sidenav">-->
<!--                <li><a href="#">Navbar Link</a></li>-->
<!--            </ul>-->
<!--            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>-->
<!--        </div>-->
<!--    </nav>-->
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">Starter Template</h1>
            <div class="row center">
                <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
            </div>
            <div class="row center">
                <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
            </div>
            <br><br>

        </div>
    </div>


    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="page-footer orange">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Company Bio</h5>
                <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Settings</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Connect</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
