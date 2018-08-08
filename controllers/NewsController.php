<?php

namespace app\controllers;

use Yii;
use app\models\Articles;
use app\models\Categories;

class NewsController extends \yii\web\Controller
{
    public $layout;
    
    public function actionIndex()
    {
        $this->layout = 'news';
        
        $categories = new Categories();
        $category_id = $categories->getIdByUrl(Yii::$app->request->url);
        
        $articles = new Articles();
        $news = $articles->getNews($category_id);
        
        $this->view->title = 'Новости';
        
        return $this->render('index',[
            'news' => $news
        ]);
    }
    
    public function actionAjax()
    {
        $startFrom = $_POST['startFrom'];
        
        $categories = new Categories();
        $category_id = $categories->getIdByName('Новости');

        $articles = new Articles();
        $res = $articles->getNews($category_id, $startFrom);
        
        // Формируем массив со статьями
        $articles_array = [];
        foreach($res as $key=>$value){
            foreach($value as $key_obj => $value_obj){
                    if($key_obj == 'created_at'){
                        $created_at = Articles::getDate($value_obj);
                        $value_obj = $created_at;
                    }
                    $articles_array[$key][$key_obj] = $value_obj;
            }
       }
        
        echo json_encode($articles_array);
        die;
    }
    
    public function actionArticle($alias)
    {
        $this->layout = 'article';
        
        $alias = trim(stripslashes(htmlspecialchars($alias)));
        
        $articles = new Articles();
        $categories = new Categories();
        
        $article = $articles->getArticleByAlias($alias);
        
        if($article->category_id){
            $lastArticles = $articles->getLastArticles($article->category_id, $article->id);
            
            $parentCategories = $categories->getSubCategories($article->category_id);
            $brothersCategories = $categories->getBrothersCategories($parentCategories->parent_id);
            $view = '/handler/one_article';
            
            $this->view->params['breadcrumbs'] = [
                ['label' => 'Новости', 'url' => ['/news']],
                ['label' => Articles::cutArticleTitle($article->title)]
            ];
        }
        else{
            $view = '/static/404';
        }
        
        $this->view->title = $article->title;
        
        return $this->render($view, [
            'article' => $article,
            'lastArticles' => $lastArticles,
            'brothersCategories' => $brothersCategories
        ]);
    }
}
