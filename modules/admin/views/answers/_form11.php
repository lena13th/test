<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Answers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answers-form">

    <?php
    $form = ActiveForm::begin();

    echo '<div class="answer_new">';
    if (($task_type==1)||($task_type==2)){


        foreach ($answers as $index => $answer) {
            $last_index=$index;
            echo '<div>';
            echo $form->field($answer, "[$index]text", ['options' => ['class' => 'form-group field_check_1']])->label(false);
            echo $form->field($answer, "[$index]correct", ['options' => ['class' => 'form-group field_check_2']])->checkbox();
            echo '</div>';


        }
    } elseif ($task_type==3){
        foreach ($answers as $index => $answer) {

            echo '<div>';
//            echo $form->field($answer, "[$index]correct",['options' => ['class' => 'form-group field_check_3']])->label(false);
            echo $answer->correct . '. ';
            echo $form->field($answer, "[$index]text", ['options' => ['class' => 'form-group field_check_1']])->label(false);
            echo '</div>';
        }
    } elseif ($task_type==4) {
        foreach ($answers as $index => $answer) {

//            $answer += array('index'=>$index) ;
//            $modif_answer[]['index'] =$index ;
            if (iconv_strlen($answer->correct) === 3) {
                $modif_answers[strval($answer->correct)[2]][2] = $answer;
                $index_answer[strval($answer->correct)[2]][2] = $index;
            } else {
                $modif_answers[$answer['correct']][1] = $answer;
                $index_answer[$answer['correct']][1]=$index;
            }
        }

        foreach ($modif_answers as $ii=>$answer) {
            echo '<div>';
            echo $ii.'. ';
            $index1=$index_answer[$ii][1];
            $index2=$index_answer[$ii][2];
            echo $form->field($answer[1], "[$index1]text", ['options' => ['class' => 'form-group field_check_2']])->label(false);
            echo $form->field($answer[2], "[$index2]text", ['options' => ['class' => 'form-group field_check_2']])->label(false);
            echo '</div>';

//            $answer[1]['text'];
//            $answer[2]['text'];
        }
    }



echo '</div>';

    echo '<div class="form-group">';
        echo Html::submitButton('Добавить строку', ['class' => 'btn answer_new_button']);

//        echo Html::button('Сохранить', ['class' => 'btn btn-success']);
    echo '</div>';

    echo '<div class="form-group">';
        echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']);
    echo '</div>';

    ActiveForm::end();

    ?>
<?php
if ($task_type==1) {
    $this->registerJs("
$('input[type=\"checkbox\"]').on('change', function() {
   $('input[type=\"checkbox\"]').not(this).prop('checked', false);
});

$('.answer_new_button').on('click', function() {
        var nameLastAnswer = document.getElementsByClassName('answer_new')[0].lastChild.firstChild.getElementsByTagName('input')[0].getAttribute('name');
        alert(nameLastAnswer);

        
    });

");
}
?>

<!--    //        var newLi = document.createElement('div');-->
<!--    //        document.getElementsByClassName('answer_new')[0].appendChild(newLi);-->

<!--    <div>-->
<!--        <div class="form-group field_check_1 field-answers-3-text required has-success">-->
<!--            <input type="text" id="answers-3-text" class="form-control" name="Answers[3][text]" value="Концептуальная фаза" aria-invalid="false">-->
<!--            <div class="help-block"></div>-->
<!--        </div>-->
<!--        <div class="form-group field_check_2 field-answers-3-correct">-->
<!--            <input type="hidden" name="Answers[3][correct]" value="0">-->
<!--            <label>-->
<!--                <input type="checkbox" id="answers-3-correct" name="Answers[3][correct]" value="1" checked=""> Верный ответ-->
<!--            </label>-->
<!--            <div class="help-block"></div>-->
<!--        </div>-->
<!--    </div>-->


<!--    --><?php //echo $task; ?>
<!---->
<!--    <pre>-->
<!--        --><?php //print_r($models);?>
<!--    </pre>-->
<!--    --><?php //$form = ActiveForm::begin(); ?>
<?php //            foreach ($models as $model):
//?>
<!--    --><?//= $form->field($model, 'taskid')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
<!---->
<!--    --><?//= $form->field($model, 'correct')->textInput() ?>
<!--                --><?php //endforeach;?>
<!---->
<!--    <div class="form-group">-->
<!--        --><?//= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<!--    </div>-->
<!---->
<!--    --><?php //ActiveForm::end(); ?>


</div>
