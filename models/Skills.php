<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skillstable".
 *
 * @property int $id
 * @property string $name
 * @property string $note
 *
 * @property Casestable[] $casestables
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skillstable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'note'], 'required'],
            [['name', 'note'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCases()
    {
        return $this->hasMany(Cases::className(), ['skillid' => 'id']);
    }
}
