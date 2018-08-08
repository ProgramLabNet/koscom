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
            $name = $article->category->name;
            $url = $article->category->url;
            $category_article = $articles->getCategoryArticlesByCategoryIdAdnAlias($article->category_id);
            
        }
        else{
            $category = $categories->getCategoriesByUrl(Yii::$app->request->url);
            $name = $category->name;
            $url = $category->url;
            $category_article = $articles->getCategoryArticlesByCategoryIdAdnAlias($category->id);
            $article = $articles->getOneArticleByCategoryIdAndAlias($category->id);
        }
        
        if($article){
            $this->view->title = $article->title;
            $this->view->params['breadcrumbs'] = [
                ['label' => $name, 'url' => [$url]],
                ['label' => Articles::cutArticleTitle($article->title)]
            ];
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
