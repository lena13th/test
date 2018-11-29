<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->params['active_page'][] = 'training';

?>


<div class="col s12 nav-wrapper valign-wrapper">
    <a href="<?= Url::to(['/site/index'])?>" class="breadcrumb grey-text text-lighten-1">Главная</a>
    <a href="<?= Url::to(['/training/index'])?>" class="breadcrumb grey-text text-lighten-1">Обучение</a>
    <a href="<?= Url::to(['/training/view', 'id'=>$grf->id])?>" class="breadcrumb grey-text text-lighten-1 tooltipped"
       data-position="bottom" data-tooltip="<?=$grf->name?>"><?=mb_strimwidth ($grf->name,0, 30, '...')?></a>
    <a class="breadcrumb grey-text text-lighten-1"><?=$case->name?></a>
</div>


<div class="card box-shadow-none case">
    <div class="card-content">
        <p class="card-title center-align"><?=$case->name?></p>
        <p><?=$case->note?></p><br>



        <?php if( !empty($resources) ): ?>

            <p><b>Информационная часть:</b></p>
            <?php $n=0;
            foreach ($resources as $resource):
                $n++;?>
                <?php if( $resource->style == 2 ):?>
                    <p><?= $n.'. '.$resource->name.': '?></p>
                    <div class="center-align">
                <?= Html::img('@web/files/'.$resource->link, ['alt' => $resource->name]) ?>
                    </div>
                <?php else:
                    $file = Yii::getAlias('@web/files/1.png');
//                    return Yii::$app->response->sendFile($file);

                    ?>


                <?php endif; ?>
            <?php endforeach;?>
        <?php endif; ?>
    </div>


    <?php if( !empty($tasks) ): ?>
        <div class="card-tabs training">
            <ul class="tabs tabs-fixed-width">
        <?php $i=0;
        foreach ($tasks as $task):
            $i++;
            ?>
            <li class="tab"><a href="<?='#test' . $task->id?>" class="purple-text text-darken-4">Вопрос <?=$i?></a></li>
        <?php endforeach;?>
            </ul>
        </div>
    <?php else: ?>
        <span class="h2">Ничего не найдено</span>
        <a class="btn  btn-primary" href="<?= Url::to(['/site/index']) ?>"><span>Вернуться на главную</span></a>
    <?php endif; ?>
    <?php if( !empty($tasks) ): ?>
        <div class="card-content grey lighten-4">
        <?php foreach ($tasks as $key=>$task): ?>
            <div id="<?='test' . $task->id?>">
                <p><b><?= $task->text ?></b></p><br>

                <?php if( !empty($letters[$key]) ): ?>
                    <?php foreach ($letters[$key] as $letter): ?>
                        <p class="h5 center-align"><?=$letter->name?></p>
                        <p ><?=$letter->text?></p>
                    <?php endforeach;?>
                <?php else: ?>
                    <span class="grey-text text-lighten-1">Теория по данному вопросу еще не добавлена</span>
                <?php endif; ?>


            </div>
        <?php endforeach;?>
        </div>
    <?php endif; ?>

<!--    <div class="card-tabs">-->
<!--        <ul class="tabs tabs-fixed-width">-->
<!---->
<!--            <li class="tab"><a href="#test4">Test 1</a></li>-->
<!--            <li class="tab"><a class="active" href="#test5">Test 2</a></li>-->
<!--            <li class="tab"><a href="#test6">Test 3</a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="card-content grey lighten-4">-->
<!--        <div id="test4">Test 1</div>-->
<!--        <div id="test5">Test 2</div>-->
<!--        <div id="test6">Test 3</div>-->
<!--    </div>-->
<!--</div>-->




<?php //if( !empty($tasks) ): ?>
<!---->
<!--    --><?php //foreach ($tasks as $task): ?>
<!--        --><?//= $task->text ?>
<!--        <a href="--><?//= Url::to(['/theory/task', 'id'=>$task->id]) ?><!--" class="btn btn-default" role="button">Перейти к теории по вопросу</a>-->
<!--        <br>-->
<!--    --><?php //endforeach;?>
<?php //else: ?>
<!--    <span class="h2">Ничего не найдено</span>-->
<!--    <a class="btn  btn-primary" href="--><?//= Url::to(['/site/index']) ?><!--"><span>Вернуться на главную</span></a>-->
<?php //endif; ?>

