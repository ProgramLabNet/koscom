<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Signup;
use app\models\User;

class LoginController extends \yii\web\Controller
{
    public $layout = 'nomain';
    
    /**
     * Вход в админ панел
     * Аутентификация
     */
    public function actionIndex()
    {
        $model = new LoginForm();
        
        if(Yii::$app->request->post('LoginForm'))
        {
            $model->attributes = Yii::$app->request->post('LoginForm');
            
            if($model->validate())
            {
                if($user = $model->getUser('username', $model->username_or_email))
                {
                    if($user->isAdmin)
                    {
                        Yii::$app->user->login($user);
                        return $this->redirect(['admin/default/index']);
                    }
                }
                if($user = $model->getUser('email', $model->username_or_email))
                {
                    if($user->isAdmin)
                    {
                        Yii::$app->user->login($user);
                        return $this->redirect(['admin/default/index']);
                    }
                } 
            }
        }
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Выход из админ панели
     */
     public function actionLogout()
    {
      if(!Yii::$app->user->isGuest)
      {
          Yii::$app->user->logout();
      }
      return $this->goHome();
    }
}
