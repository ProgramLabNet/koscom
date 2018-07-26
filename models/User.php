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
    
    const SCENARIO_UPDATE = 'update';
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
            
            [['username', 'email', 'password'], 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => self::className()],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className()],
            ['password', 'string', 'min' => 6, 'max' => 20],
            ['created_at', 'default', 'value' => date('Y-m-d H:i:s')]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'isAdmin' => 'Вк.Права',
            'created_at' => 'Дата создания',
        ];
    }
    //сценарий для полей редактирования модели User
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'email', 'isAdmin'];
        
        return $scenarios;
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
