<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Resources */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['cases/index']];
$this->params['breadcrumbs'][] = ['label' => $case->name, 'url' => ['cases/view', 'id'=>$case->id]];
$this->params['breadcrumbs'][] = ['label' => 'Информационная часть', 'url' => ['index', 'caseid'=>$case->id]];

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="resources-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'caseid',
            'name:ntext',
            'link:html',
//            'type',
//            'style',
        ],
    ]) ?>

</div>
