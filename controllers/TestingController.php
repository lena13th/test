<?php

namespace app\controllers;

use app\models\Answers;
use app\models\Cases;
use app\models\Results;
use app\models\Skills;
use app\models\User;
use Yii;
use yii\web\Controller;

class TestingController extends Controller
{

    public function actionIndex()
    {
        $skills_1 = Skills::find()->all();
        $skills = [];
        foreach ($skills_1 as $skill){
            $uses=0;
            $cases = Cases::find()->where(['skillid'=>$skill->id])->all();
            foreach ($cases as $case){
                if ($case->use =='2'){
                    $uses=1;
                }
            }
            if ($uses==1){
                $skills[] = $skill;
            }
        }
        return $this->render('index', compact('skills'));
    }

    public function actionView($id)
    {

        // SELECT * FROM `customer` WHERE `id` = 123
        // SELECT * FROM `order` WHERE `customer_id` = 123
        // $orders - это массив объектов Order
        //        if (empty($vacation)) throw new \yii\web\HttpException(404, 'К сожалению такой вакансии не найдено.');

        $parent_page = Skills::findOne($id);
//        $cases = $parent_page->cases;
        $cases = Cases::find()->where(['skillid'=>$id])->andWhere(['use'=>'2'])->all();

        return $this->render('view', compact('cases', 'parent_page'));
    }

    public function actionTasks($id, $grf)
    {

        $case = Cases::findOne($id);
        $tasks = $case->tasks;
        foreach ($tasks as $task) {
            $letters[] = $task->letters;
            $answers[] = $task->answers;
        }

        $resources = $case->resources;
        $grf = Skills::findOne($grf);

        $session = Yii::$app->session;
        // открываем сессию
        $session->open();
        $cc = 'cases' . $id . '.';
        $session[$cc . 'kol_task'] = count($tasks);

        return $this->render('tasks', compact('tasks', 'case', 'grf', 'resources', 'letters', 'answers'));
    }

    public function actionCheck()
    {

        $session = Yii::$app->session;


        $data = Yii::$app->request->post('data');
        $data = json_decode($data, true);


        if ($data["type"] == 1) {
            $answer = Answers::findOne($data["answer"]);
            $ret = $answer->correct;

        } elseif ($data["type"] == 2) {
            $correct_answers = Answers::find()
                ->where(['taskid' => $data["task"]])
                ->andWhere(['correct' => 1])
                ->all();
            $answer = $data["answer"];
            $correct_answers_copy = $correct_answers;

            foreach ($correct_answers as $key => $correct_answer) {
                $a = false;
                $a = array_search($correct_answer->id, $answer);
                if ($a !== false) {
                    unset($answer[$a]);
                    unset($correct_answers_copy[$key]);
                }
            }
            if (empty($answer) && empty($correct_answers_copy)) {
                $ret = 1;
            } else {
                $ret = 0;
            }

        } elseif ($data["type"] == 3) {
            $all_answers = Answers::find()
                ->where(['taskid' => $data["task"]])
                ->all();
            foreach ($all_answers as $answer) {
                $correct_answer[$answer->id] = $answer->correct;
            }
            $right_decision = 1;
            foreach ($data["answer"] as $answer) {
                if (!($correct_answer[$answer["id_modif_answer_3"]] == $answer["id_modif_answer"])) {
                    $right_decision = 0;
                }
            }
            $ret = $right_decision;

        } elseif ($data["type"] == 4) {
            $all_answers = Answers::find()
                ->where(['taskid' => $data["task"]])
                ->all();

            foreach ($all_answers as $answer) {
                $correct_answer[$answer->id] = $answer->correct;
            }
            $right_decision = 1;
            foreach ($data["answer"] as $answer) {
                $corr_modif_answer = '10' . $correct_answer[$answer["id_modif_answer"]];
                $corr_modif_answer_3 = $correct_answer[$answer["id_modif_answer_3"]];
                if (!($corr_modif_answer == $corr_modif_answer_3)) {
                    $right_decision = 0;
                }
            }
            $ret = $right_decision;
        }


        $cc = $data["cc"];

        if (!isset($session[$cc . 'sum'])) {
            $session[$cc . 'sum'] = 0;
        }
        if (!isset($session[$cc . 'kol'])) {
            $session[$cc . 'kol'] = 0;
        }
        if (!isset($session[$cc . 'date_start_test'])) {
            $session[$cc . 'date_start_test'] = 0;
        }

        $session[$cc . 'sum'] = (+$session[$cc . 'sum']) + (+$ret);
        $session[$cc . 'kol'] = $session[$cc . 'kol'] + 1;
        $session[$cc . 'date_start_test'] = (int)$data["date_start_test"];


        if ((int)$session[$cc . 'kol_task'] == (int)$session[$cc . 'kol']) {
            // закрываем сессию

            $result = new Results();
            $result->userid = Yii::$app->user->id;
            $result->caseid = $data["caseid"];
            $result->mark = ($session[$cc . 'sum'] * 100) / $session[$cc . 'kol'];
            if ( $data["casetime"]==0){
                $result->s_time = 0;
                $result->f_time = 0;

            } else {
                $result->s_time = $data["date_start_test"];
                $result->f_time = $data["date_end_test"];
            }

            $result->save();

//            unset($session[$cc . 'tabs']);
            unset($session[$cc . 'active_task']);
            unset($session[$cc . 'sum']);
            unset($session[$cc . 'kol']);
            unset($session[$cc . 'date_start_test']);

            $session->close();
            // уничтожаем сессию и все связанные с ней данные.
            $session->destroy();
        } else {
//            $task_next = $data["task"] + 1;
//            $session[$cc . 'tabs'] = 'test' . $task_next;
            $session[$cc . 'active_task'] = +$data["active_task"]+1;
        }


        return $ret;
        return $this->render('tasks', compact('result'));
    }

    public function actionClosetest()
    {

        $session = Yii::$app->session;
        $data = Yii::$app->request->post('data');
        $data = json_decode($data, true);

        $cc = $data["cc"];

        $result = new Results();
        $result->userid = Yii::$app->user->id;

        $result->caseid = $data["caseid"];

        if (($session[$cc.'kol']=='')||($session[$cc.'kol']==0)){
    $result->mark = 0;
} else {
    $result->mark = ($session[$cc.'sum']*100)/$session[$cc.'kol'];

}

        $result->s_time = $data["date_start_test"];
        $result->f_time = $data["date_end_test"];

        $result->save();

//        unset($session[$cc.'tabs']);
        unset($session[$cc.'active_task']);
        unset($session[$cc.'sum']);
        unset($session[$cc.'kol']);
        unset($session[$cc.'date_start_test']);

        $session->close();
        // уничтожаем сессию и все связанные с ней данные.
        $session->destroy();

    }
}
