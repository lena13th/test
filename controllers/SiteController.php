<?php

namespace app\controllers;

use app\models\Cases;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use app\models\Users;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionIndex()
    {
        return Yii::$app->response->redirect(['site/login']);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
            $id = Yii::$app->user->id;
            $user = User::findOne($id);
            return $this->render('lk', compact('user'));

        }
        // $this->layout = false;
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', compact('model'));
    }


    public function actionResult()
    {

        $id = Yii::$app->user->id;
        $user = Users::findOne($id);
        $results = $user->results;
        $end_result = array();

        foreach ($results as $result){
            if (isset($end_result[$result->caseid])){
                if ($end_result[$result->caseid]['mark']<$result->mark){
                    $end_result[$result->caseid]['mark'] = $result->mark;
                }
                $end_result[$result->caseid]['kol'] = $end_result[$result->caseid]['kol']+1;
            } else {
                $name_case = Cases::findOne($result->caseid)->name;
                $time = $result->f_time - $result->s_time;
                $date =  date("H:i:s", mktime(0, 0, $time));

                $end_result[$result->caseid] = array('case'=>$name_case, 'mark'=>$result->mark, 'time'=>$date, 'kol'=>1);
            }
        }


        return $this->render('result', compact('end_result'));
    }
    public function actionSignup(){
        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
            $id = Yii::$app->user->id;
            $user = User::findOne($id);
            return $this->render('lk', compact('user'));
        }
        $model = new SignupForm();

//        if($model->load(\Yii::$app->request->post()) && $model->validate()){
//            echo '<pre>'; print_r($model);
//            die;
//        }


        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->login = $model->login;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->f_name = $model->f_name;
            $user->l_name = $model->l_name;
            $user->m_name = $model->m_name;
            $user->type = 1;

            if($user->save()){
                return Yii::$app->response->redirect(['site/login', '#'=>'reg']);
            }
        }

        return $this->render('signup', compact('model'));
    }

    /**
     * Logout action.
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;

        $session->close();
        // уничтожаем сессию и все связанные с ней данные.
        $session->destroy();

        Yii::$app->user->logout();

        return $this->goHome();
    }

}
