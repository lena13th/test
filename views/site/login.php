<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Электронное образовательное приложение';

?>


<div class="row login">
<!--    <form class="col s12">-->
        <div class="row">
            <br><br><p class="center-align">Пожалуйста, введите свои данные:</p>
        </div>

                <?php $form = ActiveForm::begin([
//                    'id' => 'login-form',
                    // 'layout' => 'horizontal',
//                    'fieldConfig' => [
//                        'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
//                        'labelOptions' => ['class' => 'control-label'],
//                    ],
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
                    <div class="text_signup">
                        <a href="<?= Url::to(['/site/signup'])?>"> Зарегистрироваться</a>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
window.onload = function() {
    if (window.location.hash.indexOf('#') !== -1){
        M.toast({html: 'Вы успешно зарегистрировались. Пожалуйста, войдите под своим логином и паролем'})
    }
};
JS;

$this->registerJs($js);
?>
