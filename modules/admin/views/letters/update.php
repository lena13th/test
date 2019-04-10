<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Letters */

$this->title = 'Редактирование: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['cases/index']];
$this->params['breadcrumbs'][] = ['label' => $model->task->case->name, 'url' => ['cases/view', 'id'=>$model->task->caseid]];
$this->params['breadcrumbs'][] = ['label' => $model->task->text, 'url' => ['tasks/view', 'id'=>$model->task->id]];
$this->params['breadcrumbs'][] = ['label' => 'Теория', 'url' => ['index', 'id'=>$model->task->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="letters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
