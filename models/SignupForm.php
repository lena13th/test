<?php
namespace app\models;
use yii\base\Model;

class SignupForm extends Model{

    public $login;
    public $password;
    public $f_name;
    public $l_name;
    public $m_name;

    public function rules() {
        return [
            [['login', 'f_name', 'l_name', 'm_name', 'password'], 'string'],
            [['login', 'f_name', 'l_name', 'm_name', 'password'], 'required', 'message' => 'Заполните поле'],
            ['login', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],

        ];
    }

    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'f_name' => 'Фамилия',
            'l_name' => 'Имя',
            'm_name' => 'Отчество',
        ];
    }

}