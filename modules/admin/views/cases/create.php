<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Cases */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cases-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'skillid'=>$skillid,
    ]) ?>

</div>
