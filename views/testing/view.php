<?php
use yii\helpers\Url;
$this->params['active_page'][] = 'testing';
$this->title = 'Проверка знаний';

?>

<div class="col s12 nav-wrapper valign-wrapper breadcrumbs">
    <a href="<?= Url::to(['/site/login'])?>" class="breadcrumb grey-text text-lighten-1">Главная</a>
    <a href="<?= Url::to(['/testing/index'])?>" class="breadcrumb grey-text text-lighten-1">Проверка знаний</a>
    <a class="breadcrumb grey-text text-lighten-1 tooltipped" data-position="bottom" data-tooltip="<?=$parent_page->name?>"><?=mb_strimwidth ($parent_page->name,0, 30, '...')?></a>
</div>

<?php if( !empty($cases) ): ?>
    <ul class="collection">

    <?php $i=0;
    foreach ($cases as $case):
        $i++;?>
        <li class="collection-item">
            <a href="<?= Url::to(['/testing/tasks', 'id'=>$case->id, 'grf'=>$parent_page->id]) ?>">

                <span class="title valign-wrapper"><i class="material-icons teal-text text-darken-1">chevron_right</i>Ситуация <?=$i?>. <?= $case->name ?></span>
                <p class="note"><?= $case->note ?></p>
            </a>
        </li>
    <?php endforeach;?>

    </ul>
<?php else: ?>
    <span class="h2">Ничего не найдено</span>
    <a class="btn  btn-primary" href="<?= Url::to(['/site/login']) ?>"><span>Вернуться на главную</span></a>
<?php endif; ?>



