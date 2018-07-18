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
            [['name', 'parent_id'], 'required'],
            [['parent_id', 'level', 'status', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }
    
    public function getParentId()
    {
        $parent_id = [0 => 'Корневая категория'];
        
        if($categories = self::find()->where(['parent_id' => 0])->all()){
            $parent_id_db = ArrayHelper::map($categories,'id','name');
            
            foreach($parent_id_db as $key => $item){
                $parent_id[$key] = $item;
            }
        }
        return $parent_id;
    }
    
    public function getWhithOutChildrenId(){
        
        $all_categories = self::getCategoriesForNavMenu();
        
        if($all_categories){
            $exit_arr = [];
            foreach($all_categories as $value){
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
    public static function getCategoriesForNavMenu()
    {
        $result_arr = [];
        
        $query_arr = self::find()->andWhere(['status' => 1])->andWhere(['>', 'position', 0])->asArray()->all();
         
        if($query_arr){
            foreach ($query_arr as $key=>$value){
                if($value['parent_id'] == 0){
                    $value['name'] = mb_strtoupper($value['name']);
                    $result_arr[$value['id']] = $value;
                }
                if(!empty($result_arr)){
                    foreach($result_arr as $key_res=>$value_res){
                        if($key_res == $value['parent_id']){
                            $result_arr[$value['parent_id']]['children'][$value['id']] = $value;
                        }
                    }
                }
            }
            
            $result_arr = self::sortCategoriesArray($result_arr);
        }
        
       return $result_arr;
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
        $cat = Categories::find()->where(['name' => $name])->one();
        
        return $cat->id;
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
