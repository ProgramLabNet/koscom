<?php

namespace app\controllers;

use app\models\Articles;
use app\models\Categories;

class NewsController extends \yii\web\Controller
{
    public $layout = 'news';
    
    public function actionIndex()
    {
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
}
