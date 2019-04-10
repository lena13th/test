<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tasks */

$this->title = 'Редактирование: ' . $model->text;
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['cases/index']];
$this->params['breadcrumbs'][] = ['label' => $model->case->name, 'url' => ['cases/view', 'id'=>$model->caseid]];
$this->params['breadcrumbs'][] = ['label' => $model->text, 'url' => ['tasks/view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
