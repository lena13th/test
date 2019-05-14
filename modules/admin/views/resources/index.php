<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Информационная часть';
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['cases/index']];
$this->params['breadcrumbs'][] = ['label' => $casename, 'url' => ['cases/view', 'id'=>$caseid]];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resources-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create', 'caseid' => $caseid], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'layout' => "{items}",
        'showHeader'=> false,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'caseid',
            [
                'attribute'=>'name',
                'contentOptions' => ['class' => 'href-class'],

            ],
//            'link:ntext',
//            'type',
            //'style',

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
                location.href = '" . Url::to(['resources/view']) . "?id=' + id;
            }
        }
    });

");

?>

</div>

