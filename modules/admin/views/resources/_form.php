<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Resources */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resources-form">

    <?php $form = ActiveForm::begin(); ?>

    <label class="control-label">Кейс</label><br>
    <p><?php echo $casename ?></p>
<?php
    echo $form->field($model, "caseid", ['options' => ['class' => 'display-none hidden_correct_field']])->hiddenInput(['value' => $caseid])->label(false);
?>
<!--    --><?//= $form->field($model, 'caseid')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 1]) ?>

<!--    --><?//= $form->field($model, 'style')->textInput() ?>

    <?= $form->field($model, 'style')->dropDownList([
        '1' => 'Ссылка на файл',
        '2' => 'Встраиваемое',
    ]);
    ?>
<!--    --><?//= $form->field($model, 'link')->textarea(['rows' => 6]) ?>

    <?php
    echo $form->field($model, 'link')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            'height' => 200,
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        ]),
    ]);
    ?>


    <!--    --><?//= $form->field($model, 'type')->textInput() ?>
    <?= $form->field($model, 'type')->dropDownList([
        '1' => 'pdf',
        '2' => 'doc',
        '3'=>'видео',
        '4'=>'звук',
        '5'=>'txt'
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
