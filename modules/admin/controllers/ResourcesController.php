<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Cases;
use Yii;
use app\modules\admin\models\Resources;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResourcesController implements the CRUD actions for Resources model.
 */
class ResourcesController extends Controller
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
     * Lists all Resources models.
     * @return mixed
     */
    public function actionIndex()
    {
        $caseid =  Yii::$app->request->get('id');
        $case = Cases::findOne($caseid);

        $dataProvider = new ActiveDataProvider([
            'query' => Resources::find()->andWhere(['caseid' => $caseid]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'caseid'=>$caseid,
            'casename'=>$case->name,

        ]);
    }

    /**
     * Displays a single Resources model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Resources::findOne($id);
        $case = Cases::findOne($model->caseid);

        return $this->render('view', [
            'model' => $model,
            'case'=>$case,

        ]);
    }

    /**
     * Creates a new Resources model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $caseid =  Yii::$app->request->get('id');
        $case = Cases::findOne($caseid);

        $model = new Resources();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'caseid'=>$caseid,
            'casename'=>$case->name,
        ]);
    }

    /**
     * Updates an existing Resources model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $case = Cases::findOne($model->caseid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'caseid'=>$case->id,
            'casename'=>$case->name,

        ]);
    }

    /**
     * Deletes an existing Resources model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Resources model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resources the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resources::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
