<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Signup;
use app\models\User;

class SiteController extends Controller
{
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Вход в систему
     * Аутентификация
     */
    public function actionLogin()
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

    
    public function actionLogout()
    {
      if(!Yii::$app->user->isGuest)
      {
          Yii::$app->user->logout();
      }
      return $this->goHome();
    }
}
