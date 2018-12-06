<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Личный кабинет';
$this->params['active_page'][] = 'lk';

?>

<!--<div class="col s12 nav-wrapper valign-wrapper">-->
<!--    <a href="--><?//= Url::to(['/site/index'])?><!--" class="breadcrumb grey-text text-lighten-1">Главная</a>-->
<!--    <a class="breadcrumb grey-text text-lighten-1">Личный кабинет</a>-->
<!--</div>-->


<div class="card box-shadow-none lk">
    <div class="card-content">

        <div class="row">
            <div class="col s12 m6">
                <div class="div_a_admin">
                    <ul class="collection">
                        <a class="lk_a collection-item" href="<?= Url::to(['theory/index'])?>">Перейти к изучению теории</a>
                        <a class="lk_a collection-item" href="<?= Url::to(['training/index'])?>">Начать обучение</a>
                        <a class="lk_a collection-item" href="<?= Url::to(['testing/index'])?>">Проверить знания</a>
                    </ul>
                    <?php if ($user->type ==2) { ?>

                    <ul class="collection a_admin">
                        <a class="lk_a collection-item" href="<?= Url::to(['/admin'])?>">Перейти к административную панель</a>
                    </ul>

                    <?php } ?>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card white">
                    <div class="card-image">
                        <?= Html::img('@web/img/account.png',['class'=>'account_img']) ?>
                    </div>
                    <div class="card-content center-align info_user">
                        <p><span>Логин:</span> <?= $user->login; ?></p>
                        <p><span>Фамилия:</span> <?= $user->f_name; ?></p>
                        <p><span>Имя:</span> <?= $user->l_name; ?></p>
                        <p><span>Отчество:</span> <?= $user->m_name; ?></p>
                    </div>
                    <div class="card-action right-align">
                        <a href="<?= Url::to(['/site/logout'])?>">Выйти</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




