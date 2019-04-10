<?php

use yii\helpers\Html;
use yii\grid\GridView;use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Студенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?//= Html::a('Добавить запись о новом студенте', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'layout' => "{pager}\n{items}\n{summary}\n{pager}",

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'f_name:ntext',
            'l_name:ntext',
            'm_name:ntext',
//            'login:ntext',

            //'password:ntext',
            //'type',

//            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}&nbsp;&nbsp;{delete}'],
        ],
    ]); ?>

    <?php
$this->registerJs("

    $('td').hover(function (e) {
        e.target.style.cursor = \"pointer\";
     });
    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this){
            location.href = '" . Url::to(['students/view']) . "?id=' + id;
            

            }
    });

");

?>

</div>
