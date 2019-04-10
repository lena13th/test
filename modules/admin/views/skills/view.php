<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Skills */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Умения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Создать кейс', ['cases/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name:ntext',
            'note:ntext',
        ],
    ]) ?>
    <p class="p_head">Кейсы по данному умению:</p>
    <p>
        <?= Html::a('Создать кейс', ['cases/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
<!--    --><?php
//    if( !empty($cases) ): ?>
<!--        <ul class="collection">-->
<!---->
<!--            --><?php
//            foreach ($cases as $key=>$case):
//                ?>
<!--                <li class="collection-item">-->
<!--                    <a href="--><?//= Url::to(['cases/view', 'id'=>$case->id]) ?><!--">-->
<!---->
<!--                        <span class="title valign-wrapper"> --><?//=$key+1?><!--. --><?//= $case->name ?><!--</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--            --><?php //endforeach;?>
<!---->
<!--        </ul>-->
<!--    --><?php //else: ?>
<!--            <p>Ничего не найдено</p>-->
<!--    --><?php //endif; ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'layout' => "{items}",
        'showHeader'=> false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name:ntext',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php
    $this->registerJs("

    $('td').hover(function (e) {
        var idpar=e.target.parentNode.id;
        if (idpar!='w0-filters'){
            e.target.style.cursor = \"pointer\"};
     });
    $('td').click(function (e) {
        var idpar=e.target.parentNode.id;
        if (idpar!='w0-filters'){
            var id = $(this).closest('tr').data('id');
            if(e.target == this){
                location.href = '" . Url::to(['cases/view']) . "?id=' + id;
            }
        }
    });

");

    ?>


</div>
