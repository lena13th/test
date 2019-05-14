<?php

namespace app\controllers;

use app\models\Answers;
use app\models\Cases;
use app\models\Skills;
use app\models\Tasks;
use Yii;
use yii\web\Controller;

class TrainingController extends Controller
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
        $cases = Cases::find()->where(['skillid'=>$id])->andWhere(['use'=>'1'])->all();

//        $cases = $parent_page->cases;

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

        $session = Yii::$app->session;
        // открываем сессию
        $session->open();
        $tr_cc = 'training.cases'.$id.'.';
        $session[$tr_cc.'kol_task'] = count($tasks);


        return $this->render('tasks', compact('tasks', 'case', 'grf', 'resources','letters','answers'));
    }

    public function actionCheck()
    {
        $session = Yii::$app->session;

        $data = Yii::$app->request->post('data');
        $data = json_decode($data, true);

        if ($data["type"] == 1){
            $answer = Answers::findOne($data["answer"]);
//            if ($answer->correct == 0){
//                $name = 'test'.$data["task"];
//                return Yii::$app->response->redirect(['theory/tasks', 'id'=>$data["caseid"], 'grf'=>$data["grfid"], '#' => $name]);
//            }
//            return $answer->correct;
            $ret = $answer->correct;
        } elseif ($data["type"] == 2){
            $correct_answers = Answers::find()
                ->where(['taskid' => $data["task"]])
                ->andWhere(['correct'=> 1])
                ->all();
            $answer = $data["answer"];
            $correct_answers_copy = $correct_answers;

            foreach ($correct_answers as $key=>$correct_answer){
                $a = false;
                $a = array_search($correct_answer->id, $answer);
                if ($a !== false ) {
                    unset($answer[$a]);
                    unset($correct_answers_copy[$key]);
                }
            }
            if (empty($answer) && empty($correct_answers_copy)) {
//                return '1';
                $ret = 1;
            } else {
                $ret = 0;
//                $name = 'test'.$data["task"];
//                return Yii::$app->response->redirect(['theory/tasks', 'id'=>$data["caseid"], 'grf'=>$data["grfid"], '#' => $name]);
            }
        } elseif ($data["type"] == 3){
            $all_answers = Answers::find()
                ->where(['taskid' => $data["task"]])
                ->all();
            foreach ($all_answers as $answer) {
                $correct_answer[$answer->id] = $answer->correct;
            }
            $right_decision = 1;
            foreach ($data["answer"] as $answer) {
                if (!($correct_answer[$answer["id_modif_answer_3"]] == $answer["id_modif_answer"])){
                    $right_decision = 0;
                }
            }
            $ret = $right_decision;
//            if ($right_decision == 1) {
//                return '1';
//            } else {
//                $name = 'test'.$data["task"];
//                return Yii::$app->response->redirect(['theory/tasks', 'id'=>$data["caseid"], 'grf'=>$data["grfid"], '#' => $name]);
//            }


        } elseif ($data["type"] == 4){
            $all_answers = Answers::find()
                ->where(['taskid' => $data["task"]])
                ->all();

            foreach ($all_answers as $answer) {
                $correct_answer[$answer->id] = $answer->correct;
            }
            $right_decision = 1;
            foreach ($data["answer"] as $answer) {
                $corr_modif_answer = '10'.$correct_answer[$answer["id_modif_answer"]];
                $corr_modif_answer_3 = $correct_answer[$answer["id_modif_answer_3"]];
                if (!($corr_modif_answer ==$corr_modif_answer_3)){
                    $right_decision = 0;
                }
            }
            $ret = $right_decision;

//            if ($right_decision == 1) {
//                return '1';
//            } else {
//                $name = 'test'.$data["task"];
//                return Yii::$app->response->redirect(['theory/tasks', 'id'=>$data["caseid"], 'grf'=>$data["grfid"], '#' => $name]);
//            }
        } else { $ret = 0;}



        $tr_cc = $data["tr_cc"];
        if (!isset($session[$tr_cc.'kol'])) {$session[$tr_cc.'kol'] = 0;}

        $session[$tr_cc.'kol'] = $session[$tr_cc.'kol']+1;


        if ($ret) {
            if ((int) $session[$tr_cc.'kol_task']==(int) $session[$tr_cc.'kol']){
                // закрываем сессию
                unset($session[$tr_cc.'tabs']);
                unset($session[$tr_cc.'active_task']);
                unset($session[$tr_cc.'kol']);

                $session->close();
                // уничтожаем сессию и все связанные с ней данные.
                $session->destroy();
            } else {
//                $task_next = $data["task"] + 1;
//                $session[$tr_cc.'tabs'] = 'test' . $task_next;
                $session[$tr_cc . 'active_task'] = +$data["active_task"]+1;

            }

            return $ret;
        } else {

            $name = 'test'.$data["task"];
            return Yii::$app->response->redirect(['theory/tasks', 'id'=>$data["caseid"], 'grf'=>$data["grfid"], '#' => $name]);

        }

            return $this->render('tasks', compact('result'));
    }

}
