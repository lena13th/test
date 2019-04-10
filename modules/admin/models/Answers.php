<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "answerstable".
 *
 * @property int $id
 * @property int $taskid
 * @property string $text
 * @property int $correct
 *
 * @property Tasks $task
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answerstable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taskid', 'text'], 'required'],
            [['taskid', 'correct'], 'integer'],
            [['text'], 'string'],
            [['taskid'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['taskid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'taskid' => 'Taskid',
            'text' => 'Ответ',
            'correct' => 'Верный ответ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'taskid']);
    }
}
