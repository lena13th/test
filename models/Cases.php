<?php

namespace app\models;

use Yii;

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
 * @property Skillstable $skill
 * @property Resourcestable[] $resourcestables
 * @property Resultstable[] $resultstables
 * @property Taskstable[] $taskstables
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
            'skillid' => 'Skillid',
            'name' => 'Name',
            'note' => 'Note',
            'time' => 'Time',
            'use' => 'use',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
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
}
