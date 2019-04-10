<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <label for="cases-id" class="control-label">Кейс</label>
    <select name="Tasks[caseid]" id="cases-id" class="form-control">
        <option value="0"></option>
        <?= app\modules\admin\components\CasesId::widget(['model'=>$model,'caseid'=>$caseid]) ?>
    </select><br>



    <label for="type-id" class="control-label">Тип вопроса</label>
    <select name="Tasks[type]" id="type-id" class="form-control">
        <option value="0"></option>
        <?= app\modules\admin\components\TypeId::widget(['model'=>$model]) ?>
    </select><br>

    <?= $form->field($model, 'text')->textarea(['rows' => 3]) ?>

<!--    --><?php //if (($model->type==1)||($model->type==2)) {?>
<!--        <p>-->
<!--            Ответы:-->
<!--        </p>-->
<!--    --><?php //} ?>
<!--    --><?//= app\modules\admin\components\Answers::widget(['model'=>$model]) ?>


    <div class="form-group">
        <?= Html::submitButton('Перейти к редактированию вариантов ответа', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
