<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Результаты';

if (Yii::$app->user->isGuest) {
    return Yii::$app->response->redirect(['site/login']);
}
?>

<!--<div class="col s12 nav-wrapper valign-wrapper">-->
<!--    <a href="--><?//= Url::to(['/site/index'])?><!--" class="breadcrumb grey-text text-lighten-1">Главная</a>-->
<!--    <a class="breadcrumb grey-text text-lighten-1">Личный кабинет</a>-->
<!--</div>-->


<div class="card box-shadow-none lk">
    <div class="card-content">

        <div class="row">
            <div class="col s12">
                <div class="">
                    <div class="center-align result_text">
                        <p>Результаты</p>
                    </div>

                    <table class="centered white">
                        <thead>
                        <tr>
                            <th>Наименование кейса</th>
                            <th>Оценка (%)</th>
                            <th>Количество попыток</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($end_result as $result){ ?>
                            <?php if ($result['case']){ ?>
                            <tr>
                                <td><?= $result['case'] ?></td>
                                <td><?= $result['mark'] ?></td>
                                <td><?= $result['kol'] ?></td>
                            </tr>
                                <?php }  ?>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="center-align href_lk">
                    <a class="waves-effect waves-light btn indigo " href="<?= Url::to(['/site/login'])?>">Вернуться в личный кабинет</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




