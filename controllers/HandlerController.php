<?php

namespace app\controllers;

use Yii;
use app\models\Categories;
use app\models\Articles;

class HandlerController extends \yii\web\Controller
{  
    public $layout = 'category';
    
    public function actionIndex()
    {
        $categories = new Categories();
        $articles = new Articles();
        
        $category_id = $categories->getIdByUrl(Yii::$app->request->url);
        
        $news_category_id = $categories->getIdByName('Новости');
        
        if($news_category_id){
            $lastArticles = $articles->getLastArticles($news_category_id);
        }
        
        $article = $articles->getOneArticleByCategoryId($category_id);
        
        if($article){
            $view = '/handler/one_category';  
        }
        else{
            $view = '/static/404';
        }
        
        return $this->render($view, [
            'article' => $article,
            'lastArticles' => $lastArticles
        ]);
    }
}
