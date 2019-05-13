<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Letters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letters-form">

    <?php $form = ActiveForm::begin(); ?>

    <label for="tasks-id" class="control-label">Вопрос</label>
    <select name="Letters[taskid]" id="tasks-id" class="form-control">
        <option value="0"></option>
        <?= app\modules\admin\components\TasksId::widget(['model'=>$model,'taskid'=>$taskid]) ?>
    </select><br>


    <?= $form->field($model, 'name')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standart', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);
    ?>
    <?= $form->field($model, 'order')->textInput(['style'=>'width:200px']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
