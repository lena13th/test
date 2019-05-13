<?php

namespace app\modules\admin\components;

use app\modules\admin\models\Cases;
use app\modules\admin\models\Skills;
use yii\base\Widget;
use Yii;
use yii\caching\DbDependency;

class Answers extends Widget
{

//    public $id;
    public $model;
    public $answers;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
//                Yii::$app->cache->flush();

        $model = $this->model;

        $answers =  $this->answers;

        return $this->render('answers', compact('answers', 'model'));
//        return $this->render('answers', compact('dataProvider', 'model'));
    }
}