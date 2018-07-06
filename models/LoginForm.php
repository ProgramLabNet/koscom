<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username_or_email;
    public $password;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username_or_email', 'password'], 'filter', 'filter' => 'trim'],
            [['username_or_email', 'password'], 'required'],
            ['username_or_email', 'validateUsernameOrEmail'],
            ['password', 'validatePassword'],
        ];
    }
    
    public function validateUsernameOrEmail($attribute)
    {
        if(($this->getUser('username', $this->username_or_email)) || ($this->getUser('email', $this->username_or_email)))
        {
            return true;
        }
        
        return $this->addError($attribute, 'Имя пользователя или E-mail введены не верно!');
    }

    public function validatePassword($attribute)
    {
        if($user = $this->getUser('username', $this->username_or_email))
        {
            if (!Yii::$app->getSecurity()->validatePassword($this->password, $user->password))
            {
                return $this->addError($attribute, 'Пароль введен не верно!');
            }
        }
        elseif($user = $this->getUser('email', $this->username_or_email))
        {
            if (!Yii::$app->getSecurity()->validatePassword($this->password, $user->password))
            {
                return $this->addError($attribute, 'Пароль введен не верно!');
            }
        }
    }
    
    public function getUser($user_attr, $attribute)
    {
        return User::findOne([$user_attr => $attribute]);
    }
    
    public function login()
    {
        
    }
    
    public function attributeLabels()
    {
        return [
            'username_or_email' => 'Имя пользователя или E-mail',
            'password' => 'Пароль'
        ];
    }
}
