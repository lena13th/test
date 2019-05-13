<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Answers */

$this->title = $task->text;
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['cases/index']];
$this->params['breadcrumbs'][] = ['label' => $task->case->name, 'url' => ['cases/view', 'id'=>$task->caseid]];
$this->params['breadcrumbs'][] = ['label' => $task->text, 'url' => ['tasks/view', 'id'=>$task->id]];
$this->params['breadcrumbs'][] = 'Редактировать варианты ответов';
?>
<div class="answers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $type=$task->type;
    if ($type == 1) {
        $string= "Один верный ответ";
    } elseif ($type == 2) {
        $string= "Несколько верных ответов";
    } elseif ($type == 3) {
        $string= "Верный порядок";
    } elseif ($type == 4) {
        $string= "На соответствие";
    }
    ?>
    <p class="p_head_1">Тип вопроса: <?= $string ?></p>
    <p class="p_head_1"><b>Варианты ответов:</b></p>

    <?= $this->render('_form', [
        'task_type' => $task->type,
        'savefalse' => $savefalse,
        'answers' => $answers,
    ]) ?>

</div>
