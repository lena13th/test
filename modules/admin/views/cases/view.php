<?php

use app\models\Skills;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Cases */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cases-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Информационная часть', ['resources/index', 'caseid' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            [
                'attribute'=>'skillid',
                'value' => $model->getF_skillid($model),
                'format'=>'html'
            ],

            'name:ntext',
            [
                'attribute'=>'note',
                'format'=>'html'
            ],
//            'time:ntext',
            [
                'attribute'=>'time',
                'value' => function($data){
                    if ($data->time==0){
                        return 'без ограничений';
                    } else {
                        return $data->time;
                    }
                }
//                $model->getF_skillid($model),
//                'format'=>'html'
            ],
            [
                'attribute'=>'use',
                'value' => function($data){
                    if ($data->use==1){
                        return 'Обучение';
                    } elseif ($data->use==2) {
                        return 'Проверка знаний';
                    }
                }
//                $model->getF_skillid($model),
//                'format'=>'html'
            ],
        ],
    ]) ?>






    <p class="p_head">Вопросы к кейсу:</p>
    <p>
        <?= Html::a('Создать вопрос', ['tasks/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <!--    --><?php
//    if( !empty($tasks) ): ?>
<!--        <ul class="collection">-->
<!---->
<!--            --><?php
//            foreach ($tasks as $key=>$task):
//                ?>
<!--                <li class="collection-item">-->
<!--                    <a href="--><?//= Url::to(['tasks/view', 'id'=>$task->id]) ?><!--">-->
<!---->
<!--                        <span> --><?//=$key+1?><!--. --><?//= $task->text ?><!--</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--            --><?php //endforeach;?>
<!---->
<!--        </ul>-->
<!--    --><?php //else: ?>
<!--        <p>Ничего не найдено</p>-->
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
            [
                'attribute'=>'text',
                'contentOptions' => ['class' => 'href-class'],

            ],

//            'text:ntext',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php
    $this->registerJs("

    $('td').hover(function (e) {
        if(e.target.classList.contains('href-class')) {
            e.target.style.cursor = \"pointer\";
            }
     });
    $('td').click(function (e) {
        if(e.target.classList.contains('href-class')) {
            var id = $(this).closest('tr').data('id');
            if(e.target == this){
                location.href = '" . Url::to(['tasks/view']) . "?id=' + id;
            }
        }
    });

");

    ?>



</div>
