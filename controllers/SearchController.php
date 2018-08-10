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
                
                $count = Articles::getSearchArticlesCount($query);
                
                $count = ceil($count/9);
                
                $offset = 0;
                
                $search_query= Articles::getSearchArticles($query, $offset);
            }
        }
        return $this->render('index', [
            'search_query' => $search_query,
            'query' => $query,
            'count' => $count,
            'page' => 1
        ]);
    }
    
    public function actionPager($page, $query)
    {
        $page = Html::encode($page);
        $query = Html::encode($query);
       
        $count = Articles::getSearchArticlesCount($query);
                
        $count = ceil($count/9);
        
        $offset = ($page - 1 ) * 9;
        
        $search_query= Articles::getSearchArticles($query, $offset);
        
        return $this->render('index', [
            'search_query' => $search_query,
            'query' => $query,
            'count' => $count,
            'page' => $page
        ]);
    }

}
