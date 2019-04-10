<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "taskstable".
 *
 * @property int $id
 * @property int $caseid
 * @property string $text
 * @property int $type
 *
 * @property Answers[] $answers
 * @property Letters[] $letters
 * @property Cases $case
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
            'caseid' => 'Кейс',
            'text' => 'Вопрос',
            'type' => 'Тип вопроса',
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
    public function getCase()
    {
        return $this->hasOne(Cases::className(), ['id' => 'caseid']);
    }

    function getF_caseid($model)
    {
        $case=$model->case;

        $string = '<a href="'. Url::to(['cases/view', 'id'=>$case->id]).' ">'.$case->name.'</a>';

        return $string;
    }

    function getF_typetext($model)
    {
        $type=$model->type;
        if ($type == 1) {
            $string= "Один верный ответ";
        } elseif ($type == 2) {
            $string= "Несколько верных ответов";
        } elseif ($type == 3) {
            $string= "Верный порядок";
        } elseif ($type == 4) {
            $string= "На соответствие";
        }
        return $string;
    }
}
