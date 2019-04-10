<?php

namespace app\modules\admin\components;

use app\modules\admin\models\Skills;
use yii\base\Widget;
use Yii;
use yii\caching\DbDependency;

class TypeId extends Widget
{

//    public $id;
    public $model;
    public $types=['Один верный ответ','Несколько ответов','Верный порядок','На соответствие'];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
//                Yii::$app->cache->flush();

        $model = $this->model;
        $types=$this->types;
        return $this->render('type_id', compact( 'model', 'types'));
    }
}