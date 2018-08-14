<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\models\Articles;
use yii\data\Pagination;

class SearchController extends \yii\web\Controller
{
    public $layout = 'search';
    
    public function actionIndex($page=null, $query=null)
    {
        if($page && $query){
            return $this->actionPager($page, $query);
        }
        
        $model_search = new \app\models\SearchForm();
        
        if(Yii::$app->request->post('SearchForm'))
        {
            $model_search->attributes = Yii::$app->request->post('SearchForm');
            
            if($model_search->validate())
            {
                $query = Html::encode($model_search->query);
                
                $total_count = Articles::getSearchArticlesCount($query);
                
                $total_count = ceil($total_count/9);
                
                if($total_count < 5){
                    $count = $total_count;
                }
                else{
                    $count = 5;
                }
                
                $offset = 0;
                
                $search_query= Articles::getSearchArticles($query, $offset);
            }
        }
        return $this->render('index', [
            'search_query' => $search_query,
            'query' => $query,
            'count' => $count,
            'total_count' => $total_count,
            'page' => 1,
            'j' => 1
        ]);
    }
    
    public function actionPager($page, $query)
    {
        $page = Html::encode($page);
        $query = Html::encode($query);
       
        $total_count = Articles::getSearchArticlesCount($query);
                
        $total_count = ceil($total_count/9);
        
        $offset = ($page - 1 ) * 9;
        
        $search_query= Articles::getSearchArticles($query, $offset);
        
        $count = ceil($page/5) * 5;
        
        if($total_count < 5){
            $count = $total_count;
            $j = 1;
        }
        else{
            $j = $count - 5 + 1;
        }
        
        if($count > $total_count){
            $count = $count - ($count - $total_count);
        }
        
        return $this->render('index', [
            'search_query' => $search_query,
            'query' => $query,
            'count' => $count,
            'j' => $j,
            'total_count' => $total_count,
            'page' => $page
        ]);
    }

}
