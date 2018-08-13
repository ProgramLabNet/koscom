<?php

namespace app\controllers;

use Yii;
use app\models\Categories;
use app\models\Articles;
use yii\helpers\Html;

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
        
        $query_url = Html::encode(Yii::$app->request->url);
        
        //start проверка на контроллер без экшена с alias
        if($last_param = $this->getLastParam($query_url)){
            $article = $articles->getArticleByAlias($last_param);
        }
        
        if($article){
            $alias = $last_param;
        }
        //end проверка на контроллер без экшена с alias
        
        if($alias){
            $article = $articles->getArticleByAlias($alias);
            $name = $article->category->name;
            $url = $article->category->url;
            if($article->category->parent_id){
                $parent_name = $categories->getCategoryNameId($article->category->parent_id);
            }
            $category_article = $articles->getCategoryArticlesByCategoryIdAdnAlias($article->category_id);
        }
        else{
            $category = $categories->getCategoriesByUrl($query_url);
            $name = $category->name;
            $url = $category->url;
            if($category->parent_id)
            {
                $parent_name = $category->getCategoryNameId($category->parent_id);
            }
            $category_article = $articles->getCategoryArticlesByCategoryIdAdnAlias($category->id);
            $article = $articles->getOneArticleByCategoryIdAndAlias($category->id);
        }
        
        if($article){
            $this->view->title = $article->title;
            if($parent_name){
                $this->view->params['breadcrumbs'] = [
                        ['label' =>  $parent_name],
                        ['label' => $name, 'url' => [$url]],
                        ['label' => Articles::cutArticleTitle($article->title)]
                ];
            }
            else{
                $this->view->params['breadcrumbs'] = [
                        ['label' => $name, 'url' => [$url]],
                        ['label' => Articles::cutArticleTitle($article->title)]
                ];
            }
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
    
    private function getLastParam($url)
    {
        if($url){
            $param = trim($url, '/');
            
            $arr_param = explode('/', $param);
            
            if((count($arr_param) == 2) && ($arr_param[1] != '/')){
                
                return $arr_param[1];
            }
            return FALSE;
        }
        return FALSE;
    }
            
}
