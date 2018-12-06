<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userstable".
 *
 * @property int $id
 * @property string $login
 * @property string $f_name
 * @property string $l_name
 * @property string $m_name
 * @property string $password
 * @property int $type
 *
 * @property Resultstable[] $resultstables
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userstable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'f_name', 'l_name', 'm_name', 'password'], 'string'],
            [['f_name', 'l_name', 'm_name', 'password'], 'required'],
            [['type'], 'integer'],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'f_name' => 'F Name',
            'l_name' => 'L Name',
            'm_name' => 'M Name',
            'password' => 'Password',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Results::className(), ['userid' => 'id']);
    }
}
