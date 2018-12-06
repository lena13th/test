<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\Skills;
use app\models\User;
use Yii;
use yii\caching\DbDependency;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
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

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
