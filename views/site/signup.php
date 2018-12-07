<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->title = 'Электронная образовательная среда';

?>


<?php $form = ActiveForm::begin([
]) ?>

    <div class="row">
        <form class="col s12">
            <div class="row"><br>
                <p class="center-align">Пожалуйста, заполните форму регистрации</p>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <?= $form->field($model, 'login', []) ?>

<!--                    <input id="login" type="text" class="validate">-->
<!--                    <label for="login">Логин</label>-->
                </div>
                <div class="input-field col s6">
                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <!--                    <input id="password" type="password" class="validate">-->
<!--                    <label for="password">Пароль</label>-->
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <?= $form->field($model, 'f_name') ?>

                    <!--                    <input id="f_name" type="text" class="validate">-->
<!--                    <label for="f_name">Фамилия</label>-->
                </div>
                <div class="input-field col s4">
                    <?= $form->field($model, 'l_name') ?>

                    <!--                    <input id="l_name" type="text" class="validate">-->
<!--                    <label for="l_name">Имя</label>-->
                </div>
                <div class="input-field col s4">
                    <?= $form->field($model, 'm_name') ?>

                    <!--                    <input id="m_name" type="text" class="validate">-->
<!--                    <label for="m_name">Отчество</label>-->
                </div>
            </div>
            <div class="form-group center-align">
                <div>
                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
                </div>
                <div class="text_signup">
                    <a href="<?= Url::to(['/site/login'])?>"> Авторизация</a>
                </div>

            </div>

        </form>
    </div>


<?php ActiveForm::end() ?>