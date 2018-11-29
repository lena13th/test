<?php

namespace app\controllers;

use app\models\Cases;
use app\models\Skills;
use Yii;
use yii\web\Controller;

class TrainingController extends Controller
{

    public function actionIndex()
    {
        $skills = Skills::find()->all();
        return $this->render('index', compact('skills'));

    }

    public function actionView($id) {

        // SELECT * FROM `customer` WHERE `id` = 123
        // SELECT * FROM `order` WHERE `customer_id` = 123
        // $orders - это массив объектов Order
        //        if (empty($vacation)) throw new \yii\web\HttpException(404, 'К сожалению такой вакансии не найдено.');

        $parent_page = Skills::findOne($id);
        $cases = $parent_page->cases;

        return $this->render('view', compact('cases', 'parent_page'));
    }

    public function actionTasks($id, $grf) {

        $case = Cases::findOne($id);
        $tasks = $case->tasks;
        foreach ($tasks as $task){
            $letters[] = $task->letters;
            $answers[] = $task->answers;
        }

        $resources = $case->resources;
        $grf= Skills::findOne($grf);

        return $this->render('tasks', compact('tasks', 'case', 'grf', 'resources','letters','answers'));
    }

}
