<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->params['active_page'][] = 'theory';
$this->title = 'Теория';
if (Yii::$app->user->isGuest) {
    return Yii::$app->response->redirect(['site/login']);
}

?>


<div class="col s12 nav-wrapper valign-wrapper">
    <a href="<?= Url::to(['/site/login'])?>" class="breadcrumb grey-text text-lighten-1">Главная</a>
    <a href="<?= Url::to(['/theory/index'])?>" class="breadcrumb grey-text text-lighten-1">Теория</a>
    <a href="<?= Url::to(['/theory/view', 'id'=>$grf->id])?>" class="breadcrumb grey-text text-lighten-1 tooltipped"
       data-position="bottom" data-tooltip="<?=$grf->name?>"><?=mb_strimwidth ($grf->name,0, 30, '...')?></a>
    <a class="breadcrumb grey-text text-lighten-1 bread_none"><?=$case->name?></a>
</div>

<div class="card box-shadow-none case">
    <div class="card-content">
        <p class="card-title center-align"><?=$case->name?></p>
        <p><?=$case->note?></p><br>


        <?php if( !empty($resources) ): ?>
        <div class="inform">
            <p><b>Информационная часть:</b></p>
            <?php foreach ($resources as $key=>$resource):
                $key++;
                $str_start=strpos($resource->link, '">')+2;
                $str_end=strpos($resource->link, "</a>");
                $str =  $str_end-$str_start;
                $new_name = $key.'. '.$resource->name;
                $new=substr_replace($resource->link, $new_name, $str_start, $str);
                ?>

                   <?= $new ?>
            <?php endforeach;?>
        </div>

        <?php endif; ?>

        <div class="right-align">
            <a class="waves-effect waves-light btn orange lighten-3 right-align"
               href="<?= Url::to(['/training/tasks', 'id'=>$case->id, 'grf'=>$grf->id]) ?>">Перейти к обучению</a>
        </div>

    </div>

    <?php if( !empty($tasks) ): ?>
        <div class="card-tabs">
            <ul class="tabs tabs-fixed-width ul_th">
        <?php $i=0;
        foreach ($tasks as $task):
            $i++;
            ?>
            <li class="tab"><a href="<?='#test' . $task->id?>" class="orange-text text-accent-2">Теория по вопросу <?=$i?></a></li>
        <?php endforeach;?>
            </ul>
        </div>
    <?php else: ?>
    <div class="row center-align nothing_found">
        <p>Ничего не найдено</p>
        <a class="btn  btn-primary" href="<?= Url::to(['/site/login']) ?>"><span>Вернуться на главную</span></a><br>
    </div>
    <?php endif; ?>
    <?php if( !empty($tasks) ): ?>
        <div class="card-content grey lighten-4">
        <?php foreach ($tasks as $key=>$task): ?>
            <div id="<?='test' . $task->id?>">
                <p><b><?= $task->text ?></b></p><br>

                <?php if( !empty($letters[$key]) ): ?>
                    <?php foreach ($letters[$key] as $letter): ?>
                    <?php if ($letter->name){ ?>
                        <p class="h5 center-align"><?=$letter->name?></p>
                        <?php } ?>
                        <p ><?=$letter->text?></p>
                    <?php endforeach;?>
                <?php else: ?>
                    <span class="grey-text text-lighten-1">Теория по данному вопросу еще не добавлена</span>
                <?php endif; ?>


            </div>
        <?php endforeach;?>
        </div>
    <?php endif; ?>


<?php
$js = <<<JS
window.onload = function() {
    if (window.location.hash.indexOf('#') !== -1){
        M.toast({html: 'Вы ответили неверно. Необходимо изучить теорию по данному вопросу'})
    }
};
JS;

$this->registerJs($js);
?>