<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\components\BirthdayWidget;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
    <a href="<?= Url::to(Url::to(['/admin'])) ?>" class="logo">
        <span class="logo-mini"><small>Админ. панель</small></span><span class="logo-lg">Админ. панель</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">

<!--        <a href="#" id="menu-toggle" class="sidebar-toggle" data-toggle="sidebar" role="button">-->
<!--            <span class="sr-only">Toggle navigation</span>-->
<!--        </a>-->

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <?= Html::a('<span>Перейти на сайт <i class="fa fa-external-link"></i></span>', Yii::$app->homeUrl, ['class' => 'admhome', 'target'=> '_blank']) ?>
                <li class="dropdown user user-menu pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span class="hidden-xs">Администратор</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                    Вы вошли с правами администратора
                                <br>
                                <br>
                                                            <small>
                                Фамилия: <?= Yii::$app->user->identity["f_name"] ?><br>
                                Имя: <?= Yii::$app->user->identity["l_name"] ?><br>
                                Отчество: <?= Yii::$app->user->identity["m_name"] ?><br>
                                                            </small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выйти',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!-- <li> -->
                <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
                <!-- </li> -->
            </ul>
        </div>
    </nav>
</header>
