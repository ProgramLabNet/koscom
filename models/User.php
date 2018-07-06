<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $isAdmin
 * @property string $created_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'isAdmin'], 'required'],
            [['isAdmin'], 'integer'],
            [['created_at'], 'safe'],
            [['username', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'isAdmin' => 'Is Admin',
            'created_at' => 'Created At',
        ];
    }
    
    //IdentityInterface
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
     public function getId()
    {
        return $this->id;
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {  
    }
    
    public function getAuthKey()
    { 
    }
    
    public function validateAuthKey($authKey)
    {
    }
}
