<?php

use yii\helpers\Html;
use yii\helpers\Url;
if (Yii::$app->user->isGuest) {
    return Yii::$app->response->redirect(['site/login']);
}

$this->params['active_page'][] = 'testing';
$this->title = 'Проверка знаний';

$session = Yii::$app->session;

?>


    <div class="col s12 nav-wrapper valign-wrapper">
        <a href="<?= Url::to(['/site/login'])?>" class="breadcrumb grey-text text-lighten-1">Главная</a>
        <a href="<?= Url::to(['/testing/index'])?>" class="breadcrumb grey-text text-lighten-1">Проверка знаний</a>
        <a href="<?= Url::to(['/testing/view', 'id'=>$grf->id])?>" class="breadcrumb grey-text text-lighten-1 tooltipped"
           data-position="bottom" data-tooltip="<?=$grf->name?>"><?=mb_strimwidth ($grf->name,0, 30, '...')?></a>
        <a class="breadcrumb grey-text text-lighten-1"><?=$case->name?></a>
    </div>
<?php
$cc = 'cases'.$case->id.'.';

?>

    <!--        таймер -->
    <ul class="countdown">
<!--        <li> <span class="days">00</span>-->
<!--            <p class="days_ref">days</p>-->
<!--        </li>-->
<!--        <li class="seperator">.</li>-->
        <li> <span class="hours">00</span>
            <p class="hours_ref">часов</p>
        </li>
        <li class="seperator">:</li>
        <li> <span class="minutes">00</span>
            <p class="minutes_ref">минут</p>
        </li>
        <li class="seperator">:</li>
        <li> <span class="seconds">00</span>
            <p class="seconds_ref">секунд</p>
        </li>
    </ul>
    <!--end таймер-->


    <div
            class='hidden'
            caseid='<?= $case->id ?>'
            grfid='<?= $grf->id ?>'
            tab_1="<?='test' . $tasks[0]->id?>"
            tabs='<?=$session[$cc.'tabs'] ?>'
            sum='<?=$session[$cc.'sum'] ?>'
            kol='<?=$session[$cc.'kol'] ?>'
            kol_task='<?=$session[$cc.'kol_task'] ?>'
            cc='<?=$cc ?>'
    ></div>

    <div class="card box-shadow-none case">
    <div class="card-content">
        <p class="card-title center-align"><?=$case->name?></p>
        <p><?=$case->note?></p><br>

        <?php if( !empty($resources) ): ?>

            <p><b>Информационная часть:</b></p>
            <?php $n=0;
            foreach ($resources as $resource):
                $n++;?>
                <?php if( $resource->style == 2 ):?>
                <p><?= $n.'. '.$resource->name.': '?></p>
                <div class="center-align">
                    <?= Html::img('@web/files/'.$resource->link, ['alt' => $resource->name]) ?>
                </div>
            <?php else:
                $file = Yii::getAlias('@web/files/1.png');
//                    return Yii::$app->response->sendFile($file);

                ?>


            <?php endif; ?>
            <?php endforeach;?>
        <?php endif; ?>
    </div>


<?php if( !empty($tasks) ): ?>
    <div class="card-tabs testing">
        <ul class="tabs tabs-fixed-width">
            <?php $i=0;
            foreach ($tasks as $task):
                $i++;
                ?>
                <li class="tab <?php if ($i!==1){echo 'disabled ';}?>
            <?='test' . $task->id?>"><a href="<?='#test' . $task->id?>" class="teal-text text-darken-1">Вопрос <?=$i?></a></li>
            <?php endforeach;?>
            <li class="tab disabled test_result">
                <a href="<?='#test_result'?>" class="teal-text text-darken-1">Результаты</a></li>

        </ul>
    </div>
<?php else: ?>
    <div class="row center-align nothing_found">
        <p>Ничего не найдено</p>
        <a class="btn  btn-primary" href="<?= Url::to(['/site/login']) ?>"><span>Вернуться на главную</span></a><br>
    </div>
<?php endif; ?>
<?php if( !empty($tasks) ): ?>
    <div class="card-content grey lighten-4">
        <?php foreach ($tasks as $key=>$task): ?>
            <div id="<?='test' . $task->id?>">
                <p><b><?= $task->text ?></b></p>

                <?php if( !empty($answers[$key]) ): ?>
                    <?php if ($task->type ==1):?>
                        <p class="choice_answers" typename="<?= $task->type ?>">Выберите один ответ:</p>
                        <form action="#">

                        <?php
                            $answer_new = $answers[$key];
                            $count_answers = count($answers[$key]);
                            for ($i = 1; $i <= $count_answers; $i++):
                                $rand_keys = array_rand($answer_new, 1);
                                $answer = $answer_new[$rand_keys];
                                unset ($answer_new[$rand_keys]);
                                ?>
                                <p>
                                    <label>
                                        <input name="<?='test' . $task->id?>" task="<?= $task->id ?>" answer="<?= $answer->id ?>" type="radio" />
                                        <span ><?= $answer->text ?></span>
                                    </label>
                                </p>
                            <?php endfor; ?>
                        </form>
                    <?php elseif ($task->type ==2):?>
                        <p class="choice_answers" typename="<?= $task->type ?>">Выберите один или несколько ответов:</p>
                        <?php
                            $answer_new = $answers[$key];
                            $count_answers = count($answers[$key]);
                            for ($i = 1; $i <= $count_answers; $i++):
                                $rand_keys = array_rand($answer_new, 1);
                                $answer = $answer_new[$rand_keys];
                                unset ($answer_new[$rand_keys]);
                                ?>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in" task="<?= $task->id ?>" answer="<?= $answer->id ?>"/>
                                    <span><?= $answer->text ?></span>
                                </label>
                            </p>
                            <?php endfor; ?>

                    <?php elseif ($task->type ==3):?>
                        <p class="choice_answers" typename="<?= $task->type ?>">Расположите в правильном порядке:</p>
                        <?php
                        for ($i = 1; $i <= count($answers[$key]); $i++) {
                            ?>
                            <div class="row answer">
                                <div class="input-field col s12 m1">
                                    <label><?= $i.'.  ' ?></label>
                                </div>
                                <div class="input-field col s12 m11">
                                    <select about="<?= $i ?>" task="<?= $task->id ?>">
                                        <option value="" disabled selected>Выберите ответ</option>
                                        <?php
                                        $answer_new = $answers[$key];
                                        $count_answers = count($answers[$key]);
                                        for ($j = 1; $j <= $count_answers; $j++):
                                            $rand_keys = array_rand($answer_new, 1);
                                            $answer = $answer_new[$rand_keys];
                                            unset ($answer_new[$rand_keys]);
                                            ?>
                                            <option value="<?= $answer->id ?>"><?= $answer->text ?></option>
                                        <?php endfor; ?>
                                    </select>

                                </div>
                            </div>
                        <?php }?>


                    <?php elseif ($task->type ==4):?>
                        <p class="choice_answers" typename="<?= $task->type ?>">Установите соответствие:</p>

                        <?php foreach ($answers[$key] as $answer){
                            if (iconv_strlen ($answer->correct) === 3){
                                $modif_answers[$key][2][]=$answer;
                            } else {
                                $modif_answers[$key][1][]=$answer;
                            }
                        }
                        ?>
                        <?php
                        for ($i = 1; $i <= count($modif_answers[$key][1]); $i++) {
                            ?>
                            <div class="row answer">
                                <!--                                <span class="">--><?//= $i.'.  ' ?><!----><?//= $modif_answers[$key][1][$i-1]->text?><!--</span>-->

                                <div class="input-field col s12 m4">
                                    <label class="modif_answer1" >
                                        <?= $i.'.  ' ?><?= $modif_answers[$key][1][$i-1]->text?>
                                    </label>
                                </div>
                                <div class="input-field col s12 m8">
                                    <select about="<?= $modif_answers[$key][1][$i-1]->id?>" task="<?= $task->id ?>" >
                                        <option value="" disabled selected>Выберите ответ</option>
                                        <?php
                                        $answer_new = $modif_answers[$key][2];
                                        $count_answers = count($modif_answers[$key][2]);
                                        for ($j = 1; $j <= $count_answers; $j++):
                                            $rand_keys = array_rand($answer_new, 1);
                                            $answer = $answer_new[$rand_keys];
                                            unset ($answer_new[$rand_keys]);
                                            ?>
                                            <option value="<?= $answer->id ?>"><?= $answer->text ?></option>
                                       <?php endfor; ?>
                                    </select>
                                    <!--                                    <label>--><?//= $i.'.  ' ?><!----><?//= $modif_answers[$key][1][$i-1]->text?><!--</label>-->

                                </div>
                            </div>
                        <?php }?>


                    <?php endif; ?>
                <?php else: ?>
                    <span class="grey-text text-lighten-1">Варианты ответа пока не добавлены</span>
                <?php endif; ?>


                <div class="center-align">
                    <a class="waves-effect waves-light btn answerbutton teal darken-1" about="<?='test' . $task->id?>">Сохранить ответ</a>
                </div>
            </div>
        <?php endforeach;?>
        <div id="test_result">
            <div class="center-align">
                <p class="test_result_h"></p><br>
                <p class="test_result_p"></p><br>
                <a class="waves-effect waves-light btn answerbutton teal darken-1"
                   href="<?= Url::to(['/testing/view', 'id'=>$grf->id])?>"
                >
                    Перейти к кейсам</a>
            </div>

        </div>

    </div>
<?php endif; ?>


<?php
$js = <<<JS

var tabs = document.getElementsByClassName('tabs')[0];
var instance = M.Tabs.getInstance(tabs);
var first_tabs = document.getElementsByClassName('hidden')[0].getAttribute('tabs');
var tab_1 = document.getElementsByClassName('hidden')[0].getAttribute('tab_1');
if (first_tabs===''){first_tabs = tab_1}

if (first_tabs!=tab_1){
    document.getElementsByClassName(tab_1)[0].classList.add('disabled');
    document.getElementsByClassName(first_tabs)[0].classList.remove('disabled');
    instance.select(first_tabs);
}

var sum = document.getElementsByClassName('hidden')[0].getAttribute('sum');
if (sum===''){sum = 0}
var kol = document.getElementsByClassName('hidden')[0].getAttribute('kol');
if (kol===''){kol = 0}
var cc = document.getElementsByClassName('hidden')[0].getAttribute('cc');


$('.answerbutton').click(function(){
        this.classList.add('disabled');
        var nametest = this.getAttribute('about');
        var test = document.getElementById(nametest);
        // var tabs = document.getElementsByClassName('tabs')[0];
        // var instance = M.Tabs.getInstance(tabs);
        var quest=['ов','','а','а','а','ов','ов','ов','ов','ов'];

        var hidden = document.getElementsByClassName('hidden')[0];
        var caseid = hidden.getAttribute('caseid');
        var grfid = hidden.getAttribute('grfid');
        var type = test.getElementsByClassName('choice_answers')[0].getAttribute('typename');
        
       
        var data= {};
        data.type = type;
        data.caseid = caseid;
        data.grfid = grfid;
        data.cc = cc;
        var full_selected=1;
        
        if (type == 1){
            var radios = test.getElementsByTagName('input');
            data.task = radios[0].getAttribute('task');

            for (var i = 0; i < radios.length; i++) {
                if (radios[i].type === 'radio' && radios[i].checked) {
                    data.answer = radios[i].getAttribute('answer');       
                }
            }
        } else if (type == 2){
            data.answer = [];
            var checkbox = test.getElementsByTagName('input');
            data.task = checkbox[0].getAttribute('task');
            
            for (var i = 0; i < checkbox.length; i++) {
                if (checkbox[i].type === 'checkbox' && checkbox[i].checked) {
                    data['answer'].push(checkbox[i].getAttribute('answer'));       
                }
            }
            
        } else if ((type == 3)||(type == 4)){
            var sel = test.getElementsByTagName('select');
            data.task = sel[0].getAttribute('task');
            data.answer = [];
            for (var i = 0; i < sel.length; i++) {
                var n_selected_index = sel[i].options.selectedIndex;
                var id_modif_answer = sel[i].getAttribute('about');
                
                full_selected = full_selected * n_selected_index;
                var id_modif_answer_3 = sel[i].options[n_selected_index].value;

                data['answer'].push( {id_modif_answer:id_modif_answer, id_modif_answer_3:id_modif_answer_3});
                
            }
        } else {
            alert('Ошибка');
        }

        console.log(data);
        if (full_selected == 0){
            this.classList.remove('disabled');
            M.toast({html: 'Необходимо заполнить все строки'})

        } else if (data.answer === null || data.answer === undefined){
            this.classList.remove('disabled');
            M.toast({html: 'Необходимо выбрать хотя бы один вариант ответа'})

        } else {
            self=this;
        $.ajax({
             url: '/testing/check',
             type: 'POST',
             data: {data:JSON.stringify(data)},
             success: function(res){
                 
                     sum = (+sum) +(+res);
                     kol++;
                     
                     var a = +nametest[nametest.length-1]+1;
                     document.getElementsByClassName(nametest)[0].classList.add('disabled');
                     nametest = nametest.substr(0,4)+a;
                     var new_nametest = document.getElementsByClassName(nametest)[0];
                     if (new_nametest !== undefined){
                         new_nametest.classList.remove('disabled');
                         instance.select(nametest);

                         
                     } else {
                         var test_result = document.getElementsByClassName('test_result')[0];
                         test_result.classList.remove('disabled');
                         var test_result_h = document.getElementsByClassName('test_result_h')[0];
                         var r = (sum*100)/kol;
                         test_result_h.innerHTML = 'Ваш результат '+r+'%.';
                         var test_result_p = document.getElementsByClassName('test_result_p')[0];
                         test_result_p.innerHTML = 'Вы ответили верно на '+sum+' вопрос'+quest[sum]+' из '+kol+'.';
                         instance.select('test_result');
                     }
                     
                     

             },
             error: function(){
             }
        });
        }
        return sum;
        // return false;
    });

        $('.countdown').downCount({
            date: '04/10/2019 16:30:00',
            offset: +5
        }, function () {
            alert('WOOT WOOT, done!');
        });

JS;



$this->registerJs($js);
?>