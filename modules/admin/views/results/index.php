<?php

use app\modules\admin\models\Cases;
use app\modules\admin\models\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ResultsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Результаты тестирования';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="results-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a('Create Results', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?=

    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'layout' => "{pager}\n{items}\n{summary}\n{pager}",

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'userid',
                'filter' => Html::activeDropDownList($searchModel, 'userid', ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'l_name'),['class'=>'form-control','prompt' => ' ']),
                'content'=>function($data){
                    return $data->user->l_name.' '.$data->user->f_name;
                }
            ],
            [
                'attribute'=>'caseid',
                'filter' => Html::activeDropDownList($searchModel, 'caseid', ArrayHelper::map(Cases::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => ' ']),
                'content'=>function($data){
                    return $data->case->name;
                }
            ],
            [
                'attribute'=>'mark',
                'filter' => false,
            ],
//            'mark',
            [
                'attribute'=>'s_time',
                'content'=>function($data){
                    if ($data->f_time!=0){
                        $ret=gmdate("d.m.Y H:i:s", $data->f_time);
                    } else {
                        $ret='';
                    }
                    return $ret;
                },
                'filter' => false,

            ],
            [
                'attribute'=>'f_time',
                'content'=>function($data){
                    $time=$data->f_time-$data->s_time;
                    if ($time) $ret = gmdate("H:i:s", $time);
                    else $ret = '';
                    return $ret;

                },
                'filter' => false,

            ],
//            's_time:datetime',
            //'f_time:datetime',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
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
                location.href = '" . Url::to(['results/view']) . "?id=' + id;
            }
        }
    });

");

    ?>
</div>
