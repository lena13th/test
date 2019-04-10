<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Tasks;
use Yii;
use app\modules\admin\models\Answers;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnswersController implements the CRUD actions for Answers model.
 */
class AnswersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Creates a new Answers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


        public function actionCreate()
    {
        $model = new Answers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Answers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $task =Tasks::findOne($id);
//        $models=$task->answers;


//        $count = count(Yii::$app->request->post('Setting', []));
//        $settings = [new Setting()];
//        for($i = 1; $i < $count; $i++) {
//            $settings[] = new Setting();
//        }
//





        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Answers::find()->where(['taskid'=>$id])->orderBy(['correct' => SORT_ASC])->indexBy('id')
        ]);

        if ($task->type==3) {
            $answers = Answers::find()->where(['taskid' => $id])->orderBy([
                'correct' => SORT_ASC,
            ])->all();
        } else {
            $answers = Answers::find()->where(['taskid' => $id])->orderBy([
                'text' => SORT_ASC,
            ])->all();

        }

//        print_r( Yii::$app->request->post() );

        $count = count(Yii::$app->request->post('Answers', []));
//echo $count;
        if (Model::loadMultiple($answers, Yii::$app->request->post()) && Model::validateMultiple($answers)) {
            foreach ($answers as $answer) {
//                echo $answer->correct;
//                echo '<br>';
                $answer->save(false);
            }
            return $this->redirect(['tasks/view', 'id'=> $id]);
        }

//        foreach ($models as $model)
//        {
//            echo '<pre>';
//            print_r($model->load(Yii::$app->request->post()));
//            echo '</pre>';
//            $model->load(Yii::$app->request->post());
//            $model->save();
//            if ($model->load(Yii::$app->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        }

        return $this->render('update', [
            'task' => $task,
            'dataProvider' => $dataProvider,
            'answers' => $answers,
        ]);
    }


    /**
     * Finds the Answers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Answers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Answers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
