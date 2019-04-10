<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "resultstable".
 *
 * @property int $id
 * @property int $userid
 * @property int $caseid
 * @property int $mark
 * @property int $s_time
 * @property int $f_time
 *
 * @property Users $user
 * @property Cases $case
 */
class Results extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resultstable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'caseid', 'mark', 's_time', 'f_time'], 'required'],
            [['userid', 'caseid', 'mark', 's_time', 'f_time'], 'integer'],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
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
            'userid' => 'Студент',
            'caseid' => 'Кейс',
            'mark' => 'Оценка, %',
            's_time' => 'Начало тестирования',
            'f_time' => 'Время прохождения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCase()
    {
        return $this->hasOne(Cases::className(), ['id' => 'caseid']);
    }
}
