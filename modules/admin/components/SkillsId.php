<?php

namespace app\modules\admin\components;

use app\modules\admin\models\Skills;
use yii\base\Widget;
use Yii;
use yii\caching\DbDependency;

class SkillsId extends Widget
{

//    public $id;
    public $model;
    public $skillid;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
//                Yii::$app->cache->flush();

        $model = $this->model;
        $skillid=$this->skillid;
        $skills =  Skills::find()->all();

        return $this->render('skill_id', compact('skills', 'model', 'skillid'));
    }
}