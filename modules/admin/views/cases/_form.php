<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Cases */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cases-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'skillid')->textInput() ?>
    <label for="skills-id" class="control-label">Умение</label>
    <select name="Cases[skillid]" id="skills-id" class="form-control">
        <option value="0"></option>
        <?= app\modules\admin\components\SkillsId::widget(['model'=>$model,'skillid'=>$skillid]) ?>
    </select><br>

    <?= $form->field($model, 'name')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'note')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'standart', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);
    ?>

    <?= $form->field($model, 'time')->textInput(['style'=>'width:200px']) ?>
<p>( 0 - если время выполнения не ограничено )</p>

    <?= $form->field($model, 'use')->dropDownList([
        '1' => 'Обучение',
        '2' => 'Проверка умений',
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
