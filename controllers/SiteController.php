<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Articles;
use app\models\Mainpage;

class SiteController extends Controller
{
    
    public function actions()
    {
        return [
            //'error' => [
                //'class' => 'yii\web\ErrorAction',
            //],
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
        $mainpage = new Mainpage();
        $articles = new Articles();
        
        if($arr = $mainpage->getDataForMainPage()){
            $articles_arr = $articles->getSelectData($arr);
        }
        
        return $this->render('index', [
            'articles_arr' => $articles_arr
        ]);
    }
    
    public function actionError(){
        
        $this->layout = 'nomain';
        
        return $this->render('/static/404');
    }
}
