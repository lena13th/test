<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Answers */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
function max_with_key($array, $key) {
    if (!is_array($array) || count($array) == 0) return false;
    $max = $array[0][$key];
    foreach($array as $a) {
        if($a[$key] > $max) {
            $max = $a[$key];
        }
    }
    return $max;
}
$max_correct = max_with_key($answers, 'correct');  //2343

$answers_correct = [];
foreach ($answers as $answer_correct) {
    $answers_correct[]['correct'] = $answer_correct['correct'];
}


//foreach ($answers as $index => $answer) {
//    echo '<br>';
//    print_r($answer['_errors']);
//    echo '<br>';
//    if ($answer['_errors']) echo 'не пустой'; else echo 'пустой';
//}
//echo '<pre>';
//print_r($answers);
//echo '</pre>';


?>
<div id='null_div' lenghtAnsw="<?php echo count($answers); ?>" max_correct="<?=substr($max_correct,2,1); ?>" idDivNewAnswer="0"></div>
<div class="answers-form">

    <?php
    $form = ActiveForm::begin();

    echo '<div class="div_answers">';
    if ($answers) {
        if (($task_type == 1) || ($task_type == 2)) {
            foreach ($answers as $index => $answer) {
                $last_index = $index;
                echo '<div>';
                echo $form->field($answer, "[$index]text", ['options' => ['class' => 'form-group field_check_1']])->label(false);
                echo $form->field($answer, "[$index]correct", ['options' => ['class' => 'form-group field_check_2']])->checkbox();

                if ($answer['_errors']) {
                    echo Html::button('Удалить', ['class' => 'btn btn-danger field_check_3 delete_new_answer',
                        'onclick' => 'js:mybuttondelete(' . $answer->id . ');']);
                } else {

                    echo Html::a('Удалить', ['delete', 'id' => $answer->id], [
                        'class' => 'btn btn-danger field_check_3',
                        'data' => [
                            'confirm' => 'Внимание! Перед удалением сохраните изменения!
Вы уверены что хотите удалить данную запись?',
                            'method' => 'post',
                        ],
                    ]);
                };
                echo '</div>';

            };

        } elseif ($task_type == 3) {
            function cmp($a, $b)
            {
                if ($a['correct'] == $b['correct']) return 0;
                return $a['correct'] > $b['correct'] ? 1 : -1;
            }

            usort($answers, "cmp");


            foreach ($answers as $index => $answer) {

                echo '<div>';
                echo '<span class="span_numb_answ">';
                echo $answer->correct . '. ';
                echo '</span>';
                echo $form->field($answer, "[$index]text", ['options' => ['class' => 'form-group field_check_1 field_check_5 ']])->label(false);
                echo $form->field($answer, "[$index]correct", ['options' => ['class' => 'display-none hidden_correct_field']])->hiddenInput()->label(false);

                if ($answer['_errors']) {
//                    echo Html::button('Удалить', ['class' => 'btn btn-danger field_check_3 delete_new_answer',
//                        'onclick' => 'js:mybuttondelete("noid",3);']);
                } else {

                    echo Html::a('Удалить', ['delete', 'id' => $answer->id], [
                        'class' => 'btn btn-danger field_check_4 field_check_6',
                        'data' => [
                            'confirm' => 'Внимание! Перед удалением сохраните изменения!
Вы уверены что хотите удалить данную запись?',
                            'method' => 'post',
                        ],
                    ]);
                };


                echo '</div>';
            }
        } elseif ($task_type == 4) {
            foreach ($answers as $index => $answer) {

//            $answer += array('index'=>$index) ;
//            $modif_answer[]['index'] =$index ;
                if (iconv_strlen($answer->correct) === 3) {
                    $modif_answers[strval($answer->correct)[2]][2] = $answer;
                    $index_answer[strval($answer->correct)[2]][2] = $index;
                } else {
                    $modif_answers[$answer['correct']][1] = $answer;
                    $index_answer[$answer['correct']][1] = $index;
                }
            }
            $ii = 0;
            foreach ($modif_answers as $answer) {
                $ii++;
                $index1 = $index_answer[$ii][1];
                $index2 = $index_answer[$ii][2];
                echo '<div>';
                echo $ii . '. ';
                echo $form->field($answer[1], "[$index1]text", ['options' => ['class' => 'form-group field_check_7']])->label(false);
                echo $form->field($answer[1], "[$index1]correct", ['options' => ['class' => 'display-none']])->hiddenInput()->label(false);
                echo $form->field($answer[2], "[$index2]text", ['options' => ['class' => 'form-group field_check_7']])->label(false);
                echo $form->field($answer[2], "[$index2]correct", ['options' => ['class' => 'display-none']])->hiddenInput()->label(false);
                echo '</div>';

//            $answer[1]['text'];
//            $answer[2]['text'];
            }
        }
    }



echo '</div>';
    $myvar;
    if (($savefalse==1)||(substr($max_correct,2,1)==9)){ $savedisplay=' display-none';}
    else {$savedisplay='';}

    echo '<div class="form-group div_answer_new_button'.$savedisplay.'">';
    echo Html::button('Добавить строку', ['class' => 'btn answer_new_button']);
    echo '<div class="padd_buttons_1"></div>';
    if ($task_type==3){
        echo Html::button('Добавить строку номер', ['class' => 'btn answer_new_button_number']);
        echo '<div class="padd_buttons_2"></div>';

        echo Html::dropDownList('list', $myvar, ArrayHelper::map($answers_correct, 'correct', 'correct'),['class' => 'padd_list']);

    }
//        echo Html::button('Сохранить', ['class' => 'btn btn-success']);
    echo '</div>';

    echo '<div class="form-group">';
        echo Html::submitButton('Сохранить', ['class' => 'btn btn-success save_answer_button']);
    echo '</div>';

    ActiveForm::end();

    ?>
<?php
$this->registerJs("
        
    function getSubStr(str, delim) {
        var a = str.indexOf(delim);
        if (a == -1)
            return '';
        var b = str.indexOf(delim, a+1);
        if (b == -1)
            return '';
        return str.substr(a+1, b-a-2);
    }
");
if ($task_type==1) {
    $this->registerJs("
$('input[type=\"checkbox\"]').on('change', function() {
   $('input[type=\"checkbox\"]').not(this).prop('checked', false);
});
");
}
if (($task_type==1)||($task_type==2))  {

    $this->registerJs("
$('.save_answer_button').on('click', function() {
    document.getElementsByClassName('div_answer_new_button')[0].classList.add('display-none');
});
$('.answer_new_button').on('click', function() {
        var nameLastAnswer_0 = document.getElementsByClassName('div_answers')[0].lastChild;
        if (nameLastAnswer_0){
            var nameLastAnswer = nameLastAnswer_0.firstChild.getElementsByTagName('input')[0].getAttribute('name');
            var nameDivAnswer = nameLastAnswer_0.getAttribute('idDivNewAnswer');
        }
//        var idNewAnswer=+nameLastAnswer.charAt(8)+1;
if (nameLastAnswer){
        var idNewAnswer=+getSubStr(nameLastAnswer, '[')+1;
} else {
var idNewAnswer = 0;
}

        if ((nameDivAnswer=='')||(nameDivAnswer==null)){
            var idDivNewAnswer=0;
        } else {
            var idDivNewAnswer=+nameDivAnswer+1;
        }
        
        var divNewAnswer = document.createElement('div');
        divNewAnswer.className = 'new-answer_'+idDivNewAnswer;
        divNewAnswer.setAttribute('idDivNewAnswer',idDivNewAnswer);
        document.getElementsByClassName('div_answers')[0].appendChild(divNewAnswer);
        
        var divNewAnswer_1 = document.createElement('div');
        divNewAnswer_1.className = 'form-group field_check_1 field-answers-'+idNewAnswer+'-text required';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_1);

        var inputNewAnswer_1 = document.createElement('input');
        inputNewAnswer_1.type = 'text';
        inputNewAnswer_1.id = 'answers-'+idNewAnswer+'-text';
        inputNewAnswer_1.className = 'form-control';
        inputNewAnswer_1.name = 'Answers['+idNewAnswer+'][text]';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_1);

        var divNewAnswer_11 = document.createElement('div');
        divNewAnswer_11.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_11);

        var divNewAnswer_2 = document.createElement('div');
        divNewAnswer_2.className = 'form-group field_check_2 field-answers-'+idNewAnswer+'-correct';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_2);

        var inputNewAnswer_2 = document.createElement('input');
        inputNewAnswer_2.type = 'hidden';
        inputNewAnswer_2.name = 'Answers['+idNewAnswer+'][correct]';
        inputNewAnswer_2.value = '0';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_2);

        var labelNewAnswer_2 = document.createElement('label');
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(labelNewAnswer_2);

        var inputNewAnswer_22 = document.createElement('input');
        inputNewAnswer_22.type = 'checkbox';
        inputNewAnswer_22.id = 'answers-'+idNewAnswer+'-correct';
        inputNewAnswer_22.name = 'Answers['+idNewAnswer+'][correct]';
        inputNewAnswer_22.value = '1';
        inputNewAnswer_22.checked = '';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.lastChild.appendChild(inputNewAnswer_22);

        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.lastChild.innerHTML  += ' Верный ответ';

        var divNewAnswer_22 = document.createElement('div');
        divNewAnswer_22.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_22);

        var button_1 = document.createElement('button');
        button_1.type = 'button';
        button_1.innerHTML = 'Удалить';
        button_1.className = 'btn btn-danger field_check_3 delete_new_answer';
        button_1.setAttribute('onclick', 'js:mybuttondelete('+idDivNewAnswer+');');

        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(button_1);


//        if (idNewAnswer==9){
//            document.getElementsByClassName('div_answer_new_button')[0].classList.add('display-none');
//        }
    });
");
} elseif ($task_type==3){
    $this->registerJs("
$('.save_answer_button').on('click', function() {
    document.getElementsByClassName('div_answer_new_button')[0].classList.add('display-none');
});
$('.answer_new_button').on('click', function() {
//        var nameLastAnswer = document.getElementsByClassName('div_answers')[0].lastChild.getElementsByTagName('div')[0].getElementsByTagName('input')[0].getAttribute('name');
////        var idNewAnswer=+nameLastAnswer.charAt(8)+1;
//        var idNewAnswer=+getSubStr(nameLastAnswer, '[')+1;

//        var nameDivAnswer = document.getElementsByClassName('div_answers')[0].lastChild.getAttribute('idDivNewAnswer');
//        console.log(nameDivAnswer);
//        if ((nameDivAnswer=='')||(nameDivAnswer==null)){
//            var idDivNewAnswer=0;
//        } else {
//            var idDivNewAnswer=+nameDivAnswer+1;
//        }

        var idDivNewAnswer = document.getElementById('null_div').getAttribute('idDivNewAnswer');
        var idNewAnswer = document.getElementById('null_div').getAttribute('lenghtAnsw');

        
        var divNewAnswer = document.createElement('div');
        divNewAnswer.className = 'new-answer_'+idDivNewAnswer;
        divNewAnswer.setAttribute('idDivNewAnswer',idDivNewAnswer);

        document.getElementsByClassName('div_answers')[0].appendChild(divNewAnswer);
        
        var spanNewAnswer_0 = document.createElement('span');
        spanNewAnswer_0.className = 'span_numb_answ';
        spanNewAnswer_0.innerHTML  = (+idNewAnswer+1)+'. ';

        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(spanNewAnswer_0);       
        
        var divNewAnswer_1 = document.createElement('div');
        divNewAnswer_1.className = 'form-group field_check_1 field_check_5 field-answers-'+idNewAnswer+'-text required';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_1);

        var inputNewAnswer_1 = document.createElement('input');
        inputNewAnswer_1.type = 'text';
        inputNewAnswer_1.id = 'answers-'+idNewAnswer+'-text';
        inputNewAnswer_1.className = 'form-control';
        inputNewAnswer_1.name = 'Answers['+idNewAnswer+'][text]';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_1);

        var divNewAnswer_11 = document.createElement('div');
        divNewAnswer_11.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_11);


        var divNewAnswer_2 = document.createElement('div');
        divNewAnswer_2.className = 'display-none hidden_correct_field field-answers-'+idNewAnswer+'-correct';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_2);

        var inputNewAnswer_2 = document.createElement('input');
        inputNewAnswer_2.type = 'hidden';
        inputNewAnswer_2.id = 'answers-'+idNewAnswer+'-correct';
        inputNewAnswer_2.class = 'form-control';
        inputNewAnswer_2.name = 'Answers['+idNewAnswer+'][correct]';
        inputNewAnswer_2.value = +idNewAnswer+1;
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_2);

        var divNewAnswer_22 = document.createElement('div');
        divNewAnswer_22.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_22);

        var button_1 = document.createElement('button');
        button_1.type = 'button';
        button_1.innerHTML = 'Удалить';
        button_1.className = 'btn btn-danger field_check_4 field_check_6 delete_new_answer';
        button_1.setAttribute('onclick', 'js:mybuttondelete('+idDivNewAnswer+');');
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(button_1);


        document.getElementById('null_div').setAttribute('lenghtAnsw',+idNewAnswer+1);
        document.getElementById('null_div').setAttribute('idDivNewAnswer',+idDivNewAnswer+1);


        var option_padd_list = document.createElement('option');
        option_padd_list.value = +idNewAnswer+1;
        option_padd_list.innerHTML = +idNewAnswer+1;
        document.getElementsByClassName('padd_list')[0].appendChild(option_padd_list);



//        if (idNewAnswer==9){
//            document.getElementsByClassName('div_answer_new_button')[0].classList.add('display-none');
//        }
    });
");
} elseif ($task_type==4){
    $this->registerJs("


$('.save_answer_button').on('click', function() {
    document.getElementsByClassName('div_answer_new_button')[0].classList.add('display-none');
});
$('.answer_new_button').on('click', function() {
//        var nameLastAnswer = document.getElementsByClassName('div_answers')[0].lastChild.getElementsByTagName('div')[0].getElementsByTagName('input')[0].getAttribute('name');
//        var idNewAnswer=+nameLastAnswer.charAt(8)+1;
//        var idNewAnswer=+getSubStr(nameLastAnswer, '[')+2;
        
        var null_div = document.getElementById('null_div').getAttribute('lenghtAnsw');
        var max_correct = document.getElementById('null_div').getAttribute('max_correct');
        var idNewAnswer=null_div;
                
        var numbAnswers_0=document.getElementsByClassName('div_answers')[0].lastChild;
        if (numbAnswers_0){
                var numbAnswers = numbAnswers_0.textContent;
                var nAns='';
                var iy=0;
                while(numbAnswers[iy]!=='.'){
                    nAns=nAns+numbAnswers[iy];
                    iy++;
                }
        } else {
        nAns = 0;
        }
    
        
        var nameDivAnswer = document.getElementsByClassName('div_answers')[0].lastChild;
        
        if (!nameDivAnswer){
            var idDivNewAnswer=0;
        } else {
            var idDivNewAnswer=+(nameDivAnswer.getAttribute('idDivNewAnswer'))+1;
        }
        
        var divNewAnswer = document.createElement('div');
        divNewAnswer.className = 'new-answer_'+idDivNewAnswer;
        divNewAnswer.setAttribute('idDivNewAnswer',idDivNewAnswer);
        divNewAnswer.innerHTML  = (+nAns+1)+'. ';

        document.getElementsByClassName('div_answers')[0].appendChild(divNewAnswer);

        var divNewAnswer_1 = document.createElement('div');
        divNewAnswer_1.className = 'form-group field_check_7 field-answers-'+idNewAnswer+'-text required';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_1);

        var inputNewAnswer_1 = document.createElement('input');
        inputNewAnswer_1.type = 'text';
        inputNewAnswer_1.id = 'answers-'+idNewAnswer+'-text';
        inputNewAnswer_1.className = 'form-control';
        inputNewAnswer_1.name = 'Answers['+idNewAnswer+'][text]';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_1);

        var divNewAnswer_11 = document.createElement('div');
        divNewAnswer_11.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_11);


        var divNewAnswer_2 = document.createElement('div');
        divNewAnswer_2.className = 'display-none field-answers-'+idNewAnswer+'-correct';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_2);

        var inputNewAnswer_2 = document.createElement('input');
        inputNewAnswer_2.type = 'hidden';
        inputNewAnswer_2.id = 'answers-'+idNewAnswer+'-correct';
        inputNewAnswer_2.class = 'form-control';
        inputNewAnswer_2.name = 'Answers['+idNewAnswer+'][correct]';
        inputNewAnswer_2.value = +max_correct+1;
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_2);

        var divNewAnswer_22 = document.createElement('div');
        divNewAnswer_22.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_22);
//...............................
        idNewAnswer++;
                
        var divNewAnswer_21 = document.createElement('div');
        divNewAnswer_21.className = 'form-group field_check_7 field-answers-'+idNewAnswer+'-text required';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_21);

        var inputNewAnswer_21 = document.createElement('input');
        inputNewAnswer_21.type = 'text';
        inputNewAnswer_21.id = 'answers-'+idNewAnswer+'-text';
        inputNewAnswer_21.className = 'form-control';
        inputNewAnswer_21.name = 'Answers['+idNewAnswer+'][text]';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_21);

        var divNewAnswer_211 = document.createElement('div');
        divNewAnswer_211.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_211);


        var divNewAnswer_22 = document.createElement('div');
        divNewAnswer_22.className = 'display-none field-answers-'+idNewAnswer+'-correct';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_22);

        var inputNewAnswer_22 = document.createElement('input');
        inputNewAnswer_22.type = 'hidden';
        inputNewAnswer_22.id = 'answers-'+idNewAnswer+'-correct';
        inputNewAnswer_22.class = 'form-control';
        inputNewAnswer_22.name = 'Answers['+idNewAnswer+'][correct]';
        inputNewAnswer_22.value = '10'+(+max_correct+1);
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_22);

        var divNewAnswer_222 = document.createElement('div');
        divNewAnswer_222.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_222);

        document.getElementById('null_div').setAttribute('max_correct',+max_correct+1);
        document.getElementById('null_div').setAttribute('lenghtAnsw',+idNewAnswer+1);

        if (max_correct==8){
            document.getElementsByClassName('div_answer_new_button')[0].classList.add('display-none');
        }
    });
");
}


?>


    <?php
    $this->registerJs("
    $('.answer_new_button_number').on('click', function() {
    var sel = document.getElementsByClassName('padd_list')[0];
    var selected_val = sel.options[sel.selectedIndex].value;

//        var nameLastAnswer = document.getElementsByClassName('div_answers')[0].lastChild.getElementsByTagName('div')[0].getElementsByTagName('input')[0].getAttribute('name');
////        var idNewAnswer=+nameLastAnswer.charAt(8)+1;
//        var idNewAnswer=+getSubStr(nameLastAnswer, '[')+1;

        var idNewAnswer = document.getElementById('null_div').getAttribute('lenghtAnsw');
        var idDivNewAnswer = document.getElementById('null_div').getAttribute('idDivNewAnswer');

        
        
        var divNewAnswer = document.createElement('div');
        divNewAnswer.className = 'new-answer_'+idDivNewAnswer;
        divNewAnswer.setAttribute('idDivNewAnswer',idDivNewAnswer);
        var div_answers_par=document.getElementsByClassName('div_answers')[0];
        div_answers_par.insertBefore(divNewAnswer, div_answers_par.children[selected_val-1]);
        
        var spanNewAnswer_0 = document.createElement('span');
        spanNewAnswer_0.className = 'span_numb_answ';
        spanNewAnswer_0.innerHTML  = selected_val+'. ';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(spanNewAnswer_0);

              
        var spans = document.getElementsByClassName('span_numb_answ');
        var one_tr=0;
            for(var i=0; i<spans.length; i++){
                var numb_answ=spans[i].textContent;
                var nAns='';
                var iy=0;
                while(numb_answ[iy]!=='.'){
                    nAns=nAns+numb_answ[iy];
                    iy++;
                }
                if ((+nAns)==(+selected_val)){
                    if (one_tr==0){one_tr=1} else {
                        spans[i].innerHTML = (+nAns+1)+'. ';
                    }
                }
                if ((+nAns)>(+selected_val)){
                    spans[i].innerHTML = (+nAns+1)+'. ';
                }
            }
     
        var divNewAnswer_1 = document.createElement('div');
        divNewAnswer_1.className = 'form-group field_check_1 field_check_5 field-answers-'+idNewAnswer+'-text required';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_1);

        var inputNewAnswer_1 = document.createElement('input');
        inputNewAnswer_1.type = 'text';
        inputNewAnswer_1.id = 'answers-'+idNewAnswer+'-text';
        inputNewAnswer_1.className = 'form-control';
        inputNewAnswer_1.name = 'Answers['+idNewAnswer+'][text]';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_1);

        var divNewAnswer_11 = document.createElement('div');
        divNewAnswer_11.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_11);


        var divNewAnswer_2 = document.createElement('div');
        divNewAnswer_2.className = 'display-none hidden_correct_field field-answers-'+idNewAnswer+'-correct';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(divNewAnswer_2);

        var inputNewAnswer_2 = document.createElement('input');
        inputNewAnswer_2.type = 'hidden';
        inputNewAnswer_2.id = 'answers-'+idNewAnswer+'-correct';
        inputNewAnswer_2.class = 'form-control';
        inputNewAnswer_2.name = 'Answers['+idNewAnswer+'][correct]';
        inputNewAnswer_2.value = selected_val;
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(inputNewAnswer_2);

        var divNewAnswer_22 = document.createElement('div');
        divNewAnswer_22.className = 'help-block';
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].lastChild.appendChild(divNewAnswer_22);

        var button_1 = document.createElement('button');
        button_1.type = 'button';
        button_1.innerHTML = 'Удалить';
        button_1.className = 'btn btn-danger field_check_4 field_check_6 delete_new_answer';
        button_1.setAttribute('onclick', 'js:mybuttondelete('+idDivNewAnswer+',3);');
        document.getElementsByClassName('new-answer_'+idDivNewAnswer)[0].appendChild(button_1);

        var divs = document.getElementsByClassName('hidden_correct_field');
        var one_tr_hidden_correct=0;
            for(var j=0; j<divs.length; j++){
                var numb_hidden_correct=divs[j].getElementsByTagName('input')[0].value;
                console.log(numb_hidden_correct);
                
                if ((+numb_hidden_correct)==(+selected_val)){
                    if (one_tr_hidden_correct==0){one_tr_hidden_correct=1} else {
                        divs[j].getElementsByTagName('input')[0].value = +numb_hidden_correct+1;
                    }
                }
                if ((+numb_hidden_correct)>(+selected_val)){
                        divs[j].getElementsByTagName('input')[0].value = +numb_hidden_correct+1;
                }
            }   



        document.getElementById('null_div').setAttribute('lenghtAnsw',+idNewAnswer+1);
        document.getElementById('null_div').setAttribute('idDivNewAnswer',+idDivNewAnswer+1);

        var option_padd_list = document.createElement('option');
        option_padd_list.value = +idNewAnswer+1;
        option_padd_list.innerHTML = +idNewAnswer+1;
        document.getElementsByClassName('padd_list')[0].appendChild(option_padd_list);



//        if (idNewAnswer==9){
//            document.getElementsByClassName('div_answer_new_button')[0].classList.add('display-none');
//        }
    });
");
?>
<!--    <div>-->
<!--        6.-->
<!--        <div class="form-group field_check_2 field-answers-11-text required has-success">-->
<!--            <input type="text" id="answers-11-text" class="form-control" name="Answers[11][text]" value="Разработка подсистем по отдельности, объединение - соединениеподсистем в единое целое" aria-invalid="false">-->
<!--            <div class="help-block"></div>-->
<!--        </div>-->
<!--        <div class="display-none field-answers-11-correct">-->
<!--            <input type="hidden" id="answers-11-correct" class="form-control" name="Answers[11][correct]" value="6">-->
<!--            <div class="help-block"></div>-->
<!--        </div>-->
<!--        <div class="form-group field_check_2 field-answers-9-text required">-->
<!--            <input type="text" id="answers-9-text" class="form-control" name="Answers[9][text]" value="Ответ 6">-->
<!--            <div class="help-block"></div>-->
<!--        </div>-->
<!--        <div class="display-none field-answers-9-correct">-->
<!--            <input type="hidden" id="answers-9-correct" class="form-control" name="Answers[9][correct]" value="106">-->
<!--            <div class="help-block"></div>-->
<!--        </div>-->
<!--    </div>-->

<!--    <div class="form-group field-answers-9-correct">-->
<!---->
<!--        <input type="hidden" id="answers-9-correct" class="form-control" name="Answers[9][correct]" value="7">-->
<!---->
<!--        <div class="help-block"></div>-->
<!--    </div>-->


<!--        <div>-->
<!--            7.-->
<!--            <div class="form-group field_check_1 field-answers-6-text required has-success">-->
<!--                <input type="text" id="answers-6-text" class="form-control" name="Answers[6][text]" value="Ответ 7" aria-invalid="false">-->
<!--                <div class="help-block"></div>-->
<!--            </div>-->
<!--        </div>-->
<!-----    <div>-->
<!-----        <div class="form-group field_check_1 field-answers-3-text required has-success">-->
<!-----            <input type="text" id="answers-3-text" class="form-control" name="Answers[3][text]" value="Концептуальная фаза" aria-invalid="false">-->
<!-----            <div class="help-block"></div>-->
<!-----        </div>-->
<!-----        <div class="form-group field_check_2 field-answers-3-correct">-->
<!-----            <input type="hidden" name="Answers[3][correct]" value="0">-->
<!-----            <label>-->
<!-----                <input type="checkbox" id="answers-3-correct" name="Answers[3][correct]" value="1" checked=""> Верный ответ-->
<!-----            </label>-->
<!--            <div class="help-block"></div>-->
<!-----        </div>-->
<!-----    </div>-->


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
