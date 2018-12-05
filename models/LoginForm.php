<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $login;
    public $password;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['login'], 'integer'],
//            [['login', 'type'], 'integer'],
            [['login', 'password'], 'required'],
//            [['f_name', 'l_name', 'm_name', 'password'], 'required'],
//            [['f_name', 'l_name', 'm_name', 'password'], 'string'],
//            [['login'], 'unique'],
            ['password', 'validatePassword'],

        ];
    }

    public function attributeLabels(){
        return [
            'id' => 'ID',
            'login' => 'Логин',
//            'f_name' => 'Фамилия',
//            'l_name' => 'Имя',
//            'm_name' => 'Отчество',
            'password' => 'Пароль',
//            'type' => 'Роль пользователя',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Логин/пароль введены не верно');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return php|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->login);
        }

        return $this->_user;
    }
}
