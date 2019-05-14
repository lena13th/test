<?php

namespace app\controllers;

use app\models\Cases;
use app\models\Skills;
use Yii;
use yii\web\Controller;

class TheoryController extends Controller
{

    public function actionIndex()
    {
        $skills_1 = Skills::find()->all();
        $skills = [];
        foreach ($skills_1 as $skill){
            $uses=0;
            $cases = Cases::find()->where(['skillid'=>$skill->id])->all();
            foreach ($cases as $case){
                if ($case->use =='1'){
                    $uses=1;
                }
            }
            if ($uses==1){
                $skills[] = $skill;
            }
        }
        return $this->render('index', compact('skills'));

    }

    public function actionView($id) {

        // SELECT * FROM `customer` WHERE `id` = 123
        // SELECT * FROM `order` WHERE `customer_id` = 123
        // $orders - это массив объектов Order
        //        if (empty($vacation)) throw new \yii\web\HttpException(404, 'К сожалению такой вакансии не найдено.');

        $parent_page = Skills::findOne($id);
//        $cases = $parent_page->cases;
        $cases = Cases::find()->where(['skillid'=>$id])->andWhere(['use'=>'1'])->all();

        return $this->render('view', compact('cases', 'parent_page'));
    }

    public function actionTasks($id, $grf) {

        $case = Cases::findOne($id);
        $tasks = $case->tasks;
        foreach ($tasks as $task){
            $letters[] = $task->letters;
        }

        $resources = $case->resources;
        $grf= Skills::findOne($grf);

        return $this->render('tasks', compact('tasks', 'case', 'grf', 'resources','letters'));
    }

}
