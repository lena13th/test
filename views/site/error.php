<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

//EXPERIMENT
//use app\assets\ErrorAsset;
//ErrorAsset::register($this);
use yii\helpers\Url;
?>
<div class="site-error">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <div class="status_code">
        <h1> #<?= $exception->statusCode ?></h1>
        <p><?= nl2br(Html::encode($message)) ?></p>
    </div>
</div>

<!--EXPERIMENT-->
<!--<div class="site-error">-->
<!-- <h1><?php // Html::encode($this->title) ?></h1> -->
<!--    <canvas id="scene"></canvas>-->
<!--    <input id="copy" type="text" value="# --><?//= $exception->statusCode ?><!--" />-->
<!--    <div class="alert">-->
<!--        --><?//= nl2br(Html::encode($message)) ?>
<!--    </div>-->
<!--</div>-->
