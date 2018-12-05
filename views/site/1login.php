<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Авторизация';
$this->params['active_page'][] = 'login';

?>


<div class="row">
<!--    <form class="col s12">-->
        <div class="row">
            <br>
            <br>
            <p class="center-align">Пожалуйста, введите свои данные:</p>
        </div>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    // 'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
                        'labelOptions' => ['class' => 'control-label'],
                    ],
                ]); ?>
<!--                --><?php // Yii::$app->getSecurity()->generatePasswordHash('123');?>


            <div class="row center-align">
                <div class="input-field col offset-s3 s6">
                <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>


                                </div>
                            </div>
                            <div class="row center-align">
                                <div class="input-field col offset-s3 s6">

                <?= $form->field($model, 'password')->passwordInput() ?>
                                                </div>
                                            </div>

                <div class="form-group center-align">
                    <div>
                        <?= Html::submitButton('Войти', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

<!--        <div class="row center-align">-->
<!--            <div class="input-field col offset-s3 s6">-->
<!--                <input id="login" type="text" class="validate">-->
<!--                <label for="login">Логин</label>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row center-align">-->
<!--            <div class="input-field col offset-s3 s6">-->
<!--                <input id="password" type="password" class="validate">-->
<!--                <label for="password">Пароль</label>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="center-align">-->
<!--            <button class="btn waves-effect waves-light" type="submit" name="action">Войти</button>-->
<!--        </div>-->
<!--    </form>-->
</div>



<!--<div class="site-login container">-->
<!--    --><?php //// Yii::$app->getSecurity()->generatePasswordHash('123');?>
<!--    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">-->
<!--        <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--        <p>Пожалуйста заполните поля логин и пароль:</p>-->
<!---->
<!---->
<!--        --><?//= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<!---->
<!--        --><?//= $form->field($model, 'password')->passwordInput() ?>
<!---->
<!--        --><?//= $form->field($model, 'rememberMe')->checkbox([
//            'template' => "<div>{input} {label}</div>\n<div>{error}</div>",
//        ]) ?>
<!---->
<!--        <div class="form-group">-->
<!--            <div>-->
<!--                --><?//= Html::submitButton('Войти', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        --><?php //ActiveForm::end(); ?>
<!--    </div>-->
<!--</div>-->
