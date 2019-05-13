<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "resourcestable".
 *
 * @property int $id
 * @property int $caseid
 * @property string $name
 * @property string $link
 * @property int $type
 * @property int $style
 *
 * @property Cases $case
 */
class Resources extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resourcestable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caseid', 'link', 'type'], 'required'],
            [['caseid', 'type', 'style'], 'integer'],
            [['name', 'link'], 'string'],
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
            'name' => 'Название ссылки',
            'link' => 'Ссылка ',
            'type' => 'Тип файла',
            'style' => 'Ссылка на файл/встраеваемое',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCase()
    {
        return $this->hasOne(Cases::className(), ['id' => 'caseid']);
    }
}
