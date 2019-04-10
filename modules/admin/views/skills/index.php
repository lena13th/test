<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Умения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'layout' => "{pager}\n{items}\n{summary}\n{pager}",

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
                location.href = '" . Url::to(['skills/view']) . "?id=' + id;
            }
        }
    });

");

    ?>
</div>
