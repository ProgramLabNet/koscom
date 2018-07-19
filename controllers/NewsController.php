<?php

namespace app\controllers;

use app\models\Articles;
use app\models\Categories;

class NewsController extends \yii\web\Controller
{
    public $layout;
    
    public function actionIndex()
    {
        $this->layout = 'news';
        
        $categories = new Categories();
        $category_id = $categories->getIdByName('Новости');
        
        $articles = new Articles();
        $news = $articles->getNews($category_id);
        
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
    
    public function actionArticle($id)
    {
        $this->layout = 'article';
        
        $articles = new Articles();
        $categories = new Categories();
        
        $article = $articles->getOneArticles($id);
        
        if($article->category_id){
            $lastArticles = $articles->getLastArticles($article->id, $article->category_id);
            
            $parentCategories = $categories->getSubCategories($article->category_id);
            $brothersCategories = $categories->getBrothersCategories($parentCategories->parent_id);
        }
        
        return $this->render('one_article', [
            'article' => $article,
            'lastArticles' => $lastArticles,
            'brothersCategories' => $brothersCategories
        ]);
    }
}
