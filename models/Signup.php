<?php


namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class Signup extends Model
{
    public $username;
    public $email;
    public $password;
    public $isAdmin;
    public $created_at;
    
    
    public function rules()
    {
        return[
            [['username', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['username', 'email', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => User::className()],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className()],
            ['password', 'string', 'min' => 6, 'max' => 20],
            ['isAdmin', 'default', 'value' => 0],
            ['created_at', 'default', 'value' => date('Y-m-d H:i:s')]
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'E-mail',
            'password' => 'Пароль'
        ];
    }
}
