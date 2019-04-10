<?php

namespace app\modules\admin\components;

use app\modules\admin\models\Cases;
use app\modules\admin\models\Skills;
use yii\base\Widget;
use Yii;
use yii\caching\DbDependency;

class CasesId extends Widget
{

//    public $id;
    public $model;
    public $caseid;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
//                Yii::$app->cache->flush();

        $model = $this->model;
        $caseid=$this->caseid;
        $cases =  Cases::find()->all();

        return $this->render('case_id', compact('cases', 'model', 'caseid'));
    }
}