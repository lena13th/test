<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Resources */

$this->title = 'Информационная часть';
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['cases/index']];
$this->params['breadcrumbs'][] = ['label' => $casename, 'url' => ['cases/view', 'id'=>$caseid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resources-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'caseid'=>$caseid,
        'casename'=>$casename,

    ]) ?>

</div>
