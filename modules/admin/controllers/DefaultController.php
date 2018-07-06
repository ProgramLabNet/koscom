<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Signup;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    //регистрация
    public function actionSignup()
    {
        
        $model = new Signup();

        if (Yii::$app->request->post('Signup'))
        {
            $model->attributes = Yii::$app->request->post('Signup');
            
            if ($model->validate()) {
                
                if(!Yii::$app->user->isGuest)
                {
                    $user = new User();
                
                    $user->username = $model->username;
                    $user->email = $model->email;
                    $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                    $user->isAdmin = $model->isAdmin;
                    $user->created_at = $model->created_at;

                    if($user->save())
                    {
                        return $this->goHome();
                    }
                }
            }
            
            $this->redirect(['signup']);
        }
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
