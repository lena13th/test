<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taskstable".
 *
 * @property int $id
 * @property int $caseid
 * @property string $text
 * @property int $type
 *
 * @property Answerstable[] $answerstables
 * @property Letterstable[] $letterstables
 * @property Casestable $case
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taskstable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caseid', 'text', 'type'], 'required'],
            [['caseid', 'type'], 'integer'],
            [['text'], 'string'],
            [['caseid'], 'exist', 'skipOnError' => true, 'targetClass' => Cases::className(), 'targetAttribute' => ['caseid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caseid' => 'Caseid',
            'text' => 'Text',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['taskid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLetters()
    {
        return $this->hasMany(Letters::className(), ['taskid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCases()
    {
        return $this->hasOne(Cases::className(), ['id' => 'caseid']);
    }
}
