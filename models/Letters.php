<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "letterstable".
 *
 * @property int $id
 * @property int $taskid
 * @property string $name
 * @property string $text
 * @property int $order
 *
 * @property Taskstable $task
 */
class Letters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'letterstable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taskid', 'name', 'text', 'order'], 'required'],
            [['taskid', 'order'], 'integer'],
            [['name', 'text'], 'string'],
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
            'name' => 'Name',
            'text' => 'Text',
            'order' => 'Order',
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
