<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Articles;


class IfsoservicesController extends \yii\web\Controller
{
    public $layout = 'article';
    private $_view = '/news/one_article';
    
    public function actionListservices()
    {
        
        $uri = $_SERVER['REQUEST_URI'];
        
        $params_array = $this->publicClassHandler($uri);
        
        $article = $params_array['article'];
        $lastArticles = $params_array['lastArticles'];
        $brothersCategories = $params_array['brothersCategories'];
        
        return $this->render($this->_view, [
            'article' => $article,
            'lastArticles' => $lastArticles,
            'brothersCategories' => $brothersCategories
        ]);
    }
    
    public function actionOperacionprinceple()
    {
        
        $uri = $_SERVER['REQUEST_URI'];
        
        $params_array = $this->publicClassHandler($uri);
        
        $article = $params_array['article'];
        $lastArticles = $params_array['lastArticles'];
        $brothersCategories = $params_array['brothersCategories'];
        
        return $this->render($this->_view, [
            'article' => $article,
            'lastArticles' => $lastArticles,
            'brothersCategories' => $brothersCategories
        ]);
    }
    
    public function actionDevelopers()
    {
        
        $uri = $_SERVER['REQUEST_URI'];
        
        $params_array = $this->publicClassHandler($uri);
        
        $article = $params_array['article'];
        $lastArticles = $params_array['lastArticles'];
        $brothersCategories = $params_array['brothersCategories'];
        
        return $this->render($this->_view, [
            'article' => $article,
            'lastArticles' => $lastArticles,
            'brothersCategories' => $brothersCategories
        ]);
    }
    
    public function actionNewservice()
    {
        
        $uri = $_SERVER['REQUEST_URI'];
        
        $params_array = $this->publicClassHandler($uri);
        
        $article = $params_array['article'];
        $lastArticles = $params_array['lastArticles'];
        $brothersCategories = $params_array['brothersCategories'];
        
        return $this->render($this->_view, [
            'article' => $article,
            'lastArticles' => $lastArticles,
            'brothersCategories' => $brothersCategories
        ]);
    }
    
    public function actionSuccess()
    {
        
        $uri = $_SERVER['REQUEST_URI'];
        
        $params_array = $this->publicClassHandler($uri);
        
        $article = $params_array['article'];
        $lastArticles = $params_array['lastArticles'];
        $brothersCategories = $params_array['brothersCategories'];
        
        return $this->render($this->_view, [
            'article' => $article,
            'lastArticles' => $lastArticles,
            'brothersCategories' => $brothersCategories
        ]);
    }
    
    private function publicClassHandler($uri)
    {
        $categories = new Categories();
        $category_id = $categories->getIdByUrl($uri);
        
        $articles = new Articles();
        $article = $articles->getOneArticleByCategoryId($category_id);
        
        if($article->category_id){
            $lastArticles = $articles->getLastArticles($article->id, $article->category_id);
            
            $parentCategories = $categories->getSubCategories($article->category_id);
            $brothersCategories = $categories->getBrothersCategories($parentCategories->parent_id);
        }
        
        return [
            'article' => $article,
            'lastArticles' => $lastArticles,
            'brothersCategories' => $brothersCategories
        ];
    }

}
