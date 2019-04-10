<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Results */

$this->title = $model->user->l_name.' '.$model->user->f_name.', кейс: '.$model->case->name;
$this->params['breadcrumbs'][] = ['label' => 'Результаты тестирования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="results-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить запись', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'ФИО студента',
                'value' => '<a href="'. Url::to(['students/view', 'id'=>$model->userid]).' ">'.$model->user->l_name.' '.$model->user->f_name.'</a>',
                'format'=>'html',
            ],
            [
                'label' => 'Кейс',
                'value' => '<a href="'. Url::to(['cases/view', 'id'=>$model->caseid]).' ">'.$model->case->name.'</a>',
                'format'=>'html',
            ],
            'mark',
            [
                'label' => 'Начало тестирования',
                'value' => function($data){
                    if ($data->f_time!=0){
                        $ret=gmdate("d.m.Y H:i:s", $data->f_time);
                    } else {
                        $ret='';
                    }
                    return $ret;
                }
            ],
            [
                'label' => 'Время прохождения',
                'value' => function($data){
                    $time=$data->f_time-$data->s_time;
                    if ($time) $ret = gmdate("H:i:s", $time);
                    else $ret = '';
                    return $ret;

                }
            ],
        ],
    ]) ?>

</div>
