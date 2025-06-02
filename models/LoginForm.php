<?php
namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;

    public $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                Yii::error("User not found: {$this->username}");
                $this->addError($attribute, 'Неправильный логин или пароль.');
                return;
            }

            if (!$user->validatePassword($this->password)) {
                Yii::error("Password incorrect for user: {$this->username}");
                $this->addError($attribute, 'Неправильный логин или пароль.');
            } else {
                Yii::info("Password verified for user: {$this->username}");
            }
        }
    }


    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            Yii::$app->session->set('user_id', $user->id);
            Yii::$app->session->set('username', $user->username);
            return true;
        }
        return false;
    }
}