<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Letters */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['cases/index']];
$this->params['breadcrumbs'][] = ['label' => $task->case->name, 'url' => ['cases/view', 'id'=>$task->caseid]];
$this->params['breadcrumbs'][] = ['label' => $task->text, 'url' => ['tasks/view', 'id'=>$task->id]];
$this->params['breadcrumbs'][] = ['label' => 'Теория', 'url' => ['index', 'id'=>$task->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'taskid'=>$task->id,
    ]) ?>

</div>
