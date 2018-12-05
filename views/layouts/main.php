<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

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

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->
<!--    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->

</head>
<body>
<?php $this->beginBody() ?>

<nav class="box-shadow-none">
    <div class="indigo darken-4 nav-wrapper">
        <a href="<?= Url::to(['site/index'])?>" class="brand-logo small">Система дистанционного обучения</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li
                <?php
                if ($this->params['active_page'][0] == 'theory') {
                ?>
                    class="active";
                <?php
                }
                ?>
            >
                <a href="<?= Url::to(['theory/index'])?>">Теория</a>
            </li>
            <li
                <?php
                if ($this->params['active_page'][0] == 'training') {
                    echo 'class="active"';
                }
                ?>
            >
                <a href="<?= Url::to(['training/index'])?>">Обучение</a>
            </li>
            <li
                <?php
                if ($this->params['active_page'][0] == 'testing') {
                    echo 'class="active"';
                }
                ?>
            >
                <a href="<?= Url::to(['testing/index'])?>">Проверка знаний</a>
            </li>
            <li
            <?php
            if ($this->params['active_page'][0] == 'login') {
                echo 'class="active"';
            }
            ?>
            >
                <a href="<?= Url::to(['site/login'])?>"><?php if (Yii::$app->user->isGuest) {echo 'Вход/регистрация';}
                    else {echo 'Личный кабинет';}
                    ?></a>
            </li>
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li><a href="<?= Url::to(['theory/index'])?>">Теория</a></li>
    <li><a href="<?= Url::to(['training/index'])?>">Обучение</a></li>
    <li><a href="<?= Url::to(['testing/index'])?>">Проверка знаний</a></li>

    <li class="login"><a href="<?= Url::to(['site/login'])?>">Вход/регистрация</a></li>
</ul>



<main class="container ">
<!--        --><?php
//        echo Breadcrumbs::widget([
//                'homeLink' => [
//                    'label' => 'Главная',
//                    'url' => ['site/index'],
//                    'class' => 'breadcrumb grey-text text-lighten-1',
//                ],
//            'itemTemplate' => "{link}\n",
//
//            'options' => ['class' => 'col s12 nav-wrapper valign-wrapper'],
//                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//            ]);
//        ?>

    <?= $content ?>
</main>

<footer class="page-footer white ">
    <div class="container ">
        <div class="row grey-text text-darken-2">
            <div class="col l6 s12">
                <p>Данная система предназначена для обучения и проверки знаний учеников.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h6>Карта сайта</h6>
                <ul>
                    <li><a class="grey-text text-darken-2" href="<?= Url::to(['theory/index'])?>">Теория</a></li>
                    <li><a class="grey-text text-darken-2" href="<?= Url::to(['training/index'])?>">Обучение</a></li>
                    <li><a class="grey-text text-darken-2" href="<?= Url::to(['testing/index'])?>">Проверка знаний</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright white grey-text text-darken-2 container">
        <div>
            <span class="right-align">
            2018 Разработал ученик __ группы Фаскин Виктор.
            </span>
        </div>
    </div>
</footer>
<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!--<script src="js/materialize.js"></script>-->
<!--<script src="js/init.js"></script>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
