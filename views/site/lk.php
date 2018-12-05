<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Личный кабинет';
$this->params['active_page'][] = 'lk';

?>

<div class="col s12 nav-wrapper valign-wrapper">
    <a href="<?= Url::to(['/site/index'])?>" class="breadcrumb grey-text text-lighten-1">Главная</a>
    <a class="breadcrumb grey-text text-lighten-1">Личный кабинет</a>
</div>

<div class="row">
    <div class="">
        <p> Выполнен вход под логином <?= $user->login; ?></p>
        <p> ФИО: <?= $user->f_name; ?> <?= $user->l_name; ?> <?= $user->m_name; ?></p>
        <a class="waves-effect waves-light btn" href="<?= Url::to(['/site/logout'])?>">Выйти</a>

    </div>
</div>