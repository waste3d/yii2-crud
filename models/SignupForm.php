<?php
namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'string', 'min' => 3, 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
        ];
    }
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);

        return $user->save() ? $user : null;
    }
}