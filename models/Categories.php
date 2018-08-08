<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int $level
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'parent_id','url'], 'required'],
            [['parent_id', 'level', 'status', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }
    
    public function getParentId()
    {
        $parent_id = [0 => 'Корневая категория'];
        
        if($categories = self::find()->where(['status' => 1])->all()){
            $parent_id_db = ArrayHelper::map($categories,'id','name');
            
            foreach($parent_id_db as $key => $item){
                $parent_id[$key] = $item;
            }
        }
        return $parent_id;
    }
    
    public function getWhithOutChildrenId(){
        
        $all_categories = self::getCategoriesForNavMenu();
        
        if($all_categories['whithout_else_arr']){
            
            $exit_arr = [];
            foreach($all_categories['whithout_else_arr'] as $value){
                if(!$value['children']){
                    $exit_arr[$value['id']] = $value['name'];
                }
                else{
                    foreach($value['children'] as $value_children){
                        $exit_arr[$value_children['id']] = $value_children['name'];
                    }
                }
            }
        }
        
        return $exit_arr;
    }
    
    //формирование главного навигационного меню
    public static function getCategoriesForNavMenu($parent_id = 0)
    {
        $result_arr = [];
        
        $query_arr = self::find()->andWhere(['status' => 1])->andWhere(['>', 'position', 0])->asArray()->all();
         
        if($query_arr){
            foreach ($query_arr as $key => $value){
                if($value['parent_id'] == $parent_id){
                    $value['name'] = mb_strtoupper($value['name']);
                    $result_arr[$value['id']] = $value; 
                }
            }
            
            if($result_arr){
                foreach($result_arr as $k_first => $v_first){
                    foreach($query_arr as $key_query => $v_query){
                        if($k_first == $v_query['parent_id']){
                            $result_arr[$k_first]['children'][$v_query['id']] = $v_query;
                        }
                    }
                }
            }
            
            $mainArr = self::sortCategoriesArray($result_arr);
        }
        
        $elseArr = self::addElseItemToMenu($mainArr);
        
        $public_arr['whithout_else_arr'] = $mainArr;
        $public_arr['else_arr'] =$elseArr;
        
        return $public_arr;
    }
    
    public static function addElseItemToMenu($arr){
        
        $countItem = 3;
        $elseArr = [];
        
        if(count($arr) > $countItem){
            
            for($i = 0; $i < count($arr); $i++){
                
                if($i > ($countItem - 1)){
                    
                    $elseArr['else'][] = $arr[$i];
                    continue;
                } 
                $elseArr[$i] = $arr[$i];
            }
            return $elseArr;
        }
        return;
    }
    
    //сортировка массива по ключу 'position'
    public static function  sortCategoriesArray($arr)
    {
        usort($arr, array(self, 'runRange'));
        
        foreach($arr as $key=>$value){
           if($value['children']){
               usort($value['children'], array(self, 'runRange'));
               $arr[$key]['children'] = $value['children'];
           }
        }
        return $arr;
    }
    
    //метод сравнения
    public static function  runRange($a, $b)
    {
        if ($a['position'] == $b['position']) {
            return 0;
        }
        return ($a['position'] < $b['position']) ? -1 : 1;
    }
    
    //получение id категории по ее полю 'name'
    public function getIdByName($name){
        $cat = Categories::find()->andWhere(['name' => $name])->andWhere(['status' => 1])->one();
        
        return $cat->id;
    }
    
    //получение id категории по ее полю 'uri' => 'url'
    public function getIdByUrl($url){
        $cat = Categories::find()->andWhere(['url' => $url])->andWhere(['status' => 1])->one();
        
        return $cat->id;
    }
    //получить url категории по ее id
    public static function getUrlById($id){
        
        $cat = self::find()->andWhere(['id' => $id])->andWhere(['status' => 1])->one();
        
        return $cat->url;
    }
    
    public function getSubCategories($category_id){
     
        return self::find()->where(['id' => $category_id, 'status' => 1])->one();
    }
    
    public function getBrothersCategories($id){
        return self::find()->andWhere(['parent_id' => $id, 'status' => 1])->andWhere(['!=', 'parent_id', 0])->all();
    }
    
    public function getCategoriesByUrl($url)
    {
        return self::find()->andWhere(['url' => $url, 'status' => 1])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'parent_id' => 'ID Родителя',
            'level' => 'Уровень',
            'status' => 'Статус',
            'position' => 'Позиция в меню навигации',
            'url' => 'Cсылка',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
        ];
    }
}
