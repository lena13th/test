<?php
use yii\helpers\Url;
if (Yii::$app->user->isGuest) {
    return Yii::$app->response->redirect(['site/login']);
}

$this->params['active_page'][] = 'training';
$this->title = 'Обучение';

?>

<div class="col s12 nav-wrapper valign-wrapper">
    <a href="<?= Url::to(['/site/login'])?>" class="breadcrumb grey-text text-lighten-1">Главная</a>
    <a class="breadcrumb grey-text text-lighten-1">Обучение</a>
</div>


<?php if( !empty($skills) ): ?>

<?php foreach ($skills as $key=>$skill): ?>

    <?php if ($key%2==0) echo '<div class="row">'?>

            <div class="col s12 m6">
                <div class="card box-shadow-none">
                    <div class="card-content">
                        <span class="card-title"><?= $skill->name ?></span>
                        <p><?= $skill->note ?></p>
                    </div>
                    <div class="card-action right-align">
                        <a class="purple-text text-darken-4" href="<?= Url::to(['/training/view', 'id'=>$skill->id] ) ?>">Перейти к кейсам</a>
                    </div>
                </div>
            </div>

        <?php if ($key%2==1) echo ' </div>'?>

    <?php endforeach;?>
<?php else: ?>
    <div class="row center-align nothing_found">
        <p>Ничего не найдено</p>
        <a class="btn  btn-primary" href="<?= Url::to(['/site/login']) ?>"><span>Вернуться на главную</span></a><br>
    </div>
<?php endif; ?>

