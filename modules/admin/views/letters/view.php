<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Letters */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['cases/index']];
$this->params['breadcrumbs'][] = ['label' => $model->task->case->name, 'url' => ['cases/view', 'id'=>$model->task->caseid]];
$this->params['breadcrumbs'][] = ['label' => $model->task->text, 'url' => ['tasks/view', 'id'=>$model->task->id]];
$this->params['breadcrumbs'][] = ['label' => 'Теория', 'url' => ['index', 'id'=>$model->task->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
//            'taskid',
            [
                'label' => 'Теория по вопросу',
                'value' => '<a href="'. Url::to(['tasks/view', 'id'=>$model->taskid]).' ">'.$model->task->text.'</a>',
                'format'=>'html',
            ],
            'order',
            'name:ntext',
            'text:ntext',
        ],
    ]) ?>

</div>
