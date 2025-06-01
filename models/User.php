<?php
namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%users}}';
    }
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    public function validatePassword($password)
    {
        return password_verify($password, $this->password_hash);
    }
}