<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tasks */

$this->title = $model->text;
$this->params['breadcrumbs'][] = ['label' => 'Кейсы', 'url' => ['cases/index']];
$this->params['breadcrumbs'][] = ['label' => $model->case->name, 'url' => ['cases/view', 'id'=>$model->caseid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Редактировать варианты ответа', ['letters/index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Теория по вопросу', ['letters/index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'caseid',
                'value' => $model->getF_caseid($model),
                'format'=>'html'
            ],
            [
                'attribute'=>'type',
                'value' => $model->getF_typetext($model),
                'format'=>'html'
            ],

            'text:ntext',
        ],
    ]) ?>

    <p class="p_head">
        Ответы:
    </p>
    <p>
        <?= Html::a('Редактировать варианты ответа', ['answers/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php if ($answers){ ?>
    <?= app\modules\admin\components\Answers::widget(['model'=>$model, 'answers'=>$answers]) ?>
<?php } else {
        echo '<p> Вариантов ответа не найдено</p> ';
    } ?>

</div>
