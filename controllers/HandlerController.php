<?php

namespace app\controllers;

use Yii;
use app\models\Categories;
use app\models\Articles;

class HandlerController extends \yii\web\Controller
{  
    public $layout = 'category';
    
    public function actionIndex($alias=null)
    {
        $categories = new Categories();
        $articles = new Articles();
        
        $news_category_id = $categories->getIdByName('Новости');
        
        if($news_category_id){
            $lastArticles = $articles->getLastArticles($news_category_id);
        }
        
        if($alias){
            $article = $articles->getArticleByAlias($alias);
            $category_article = $articles->getCategoryArticlesByCategoryIdAdnAlias($article->category_id);
        }
        else{
            $category_id = $categories->getIdByUrl(Yii::$app->request->url);
            $category_article = $articles->getCategoryArticlesByCategoryIdAdnAlias($category_id);
            $article = $articles->getOneArticleByCategoryIdAndAlias($category_id);
        }
        
        
        
        if($article){
            $view = '/handler/one_category';  
        }
        else{
            $view = '/static/404';
        }
        
        return $this->render($view, [
            'article' => $article,
            'lastArticles' => $lastArticles,
            'category_article' => $category_article
        ]);
    }
}
