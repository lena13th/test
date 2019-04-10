<?php

namespace app\modules\admin\components;

use app\modules\admin\models\Cases;
use app\modules\admin\models\Skills;
use app\modules\admin\models\Tasks;
use yii\base\Widget;
use Yii;
use yii\caching\DbDependency;

class TasksId extends Widget
{

//    public $id;
    public $model;
    public $taskid;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
//                Yii::$app->cache->flush();

        $model = $this->model;
        $taskid=$this->taskid;
        $tasks =  Tasks::find()->all();

        return $this->render('task_id', compact('tasks', 'model', 'taskid'));
    }
}