<?php

$this->title = 'Авторизация';
$this->params['active_page'][] = 'login';

?>


<div class="row">
    <form class="col s12">
        <div class="row">
            <h6 class="center">Пожалуйста, заполните форму регистрации</h6>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="login" type="text" class="validate">
                <label for="login">Логин</label>
            </div>
            <div class="input-field col s6">
                <input id="password" type="password" class="validate">
                <label for="password">Пароль</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s4">
                <input id="f_name" type="text" class="validate">
                <label for="f_name">Фамилия</label>
            </div>
            <div class="input-field col s4">
                <input id="l_name" type="text" class="validate">
                <label for="l_name">Имя</label>
            </div>
            <div class="input-field col s4">
                <input id="m_name" type="text" class="validate">
                <label for="m_name">Отчество</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light right" type="submit" name="action">Зарегистрироваться
        </button>
    </form>
</div>



<!--<div class="site-login container">-->
<!--    --><?php //// Yii::$app->getSecurity()->generatePasswordHash('123');?>
<!--    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">-->
<!--        <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--        <p>Пожалуйста заполните поля логин и пароль:</p>-->
<!---->
<!--        --><?php //$form = ActiveForm::begin([
//            'id' => 'login-form',
//            // 'layout' => 'horizontal',
//            'fieldConfig' => [
//                'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
//                'labelOptions' => ['class' => 'control-label'],
//            ],
//        ]); ?>
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
