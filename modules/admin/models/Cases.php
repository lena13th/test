<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "casestable".
 *
 * @property int $id
 * @property int $skillid
 * @property string $name
 * @property string $note
 * @property int $time
 * @property int $use
 *
 * @property Skills $skill
 * @property Resources[] $resources
 * @property Results[] $results
 * @property Tasks[] $tasks
 */
class Cases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'casestable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skillid', 'name', 'note', 'time','use'], 'required'],
            [['skillid', 'time','use'], 'integer'],
            [['name', 'note'], 'string'],
            [['skillid'], 'exist', 'skipOnError' => true, 'targetClass' => Skills::className(), 'targetAttribute' => ['skillid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skillid' => 'Умение',
            'name' => 'Наименование',
            'note' => 'Описание',
            'time' => 'Время выполнения, мин',
            'use' => 'Назначение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skills::className(), ['id' => 'skillid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resources::className(), ['caseid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Results::className(), ['caseid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['caseid' => 'id']);
    }

    function getF_skillid($model)
    {
        $skill=$model->skill;

        $string = '<a href="'. Url::to(['skills/view', 'id'=>$skill->id]).' ">'.$skill->name.'</a>';

        return $string;
    }

}

