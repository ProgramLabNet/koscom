<?php

namespace app\models;

use Yii;
use app\models\Categories;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $lead
 * @property string $body
 * @property string $main_image
 * @property int $status
 * @property int $category_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Categories $category
 */
class Articles extends \yii\db\ActiveRecord
{
    //введено дополнительное свойство для загрузки изображения из формы
    public $upload_image;
    public $upload_preview_image;
    
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', 'status', 'category_id', 'created_at', 'alias'], 'required'],
            [['lead', 'body'], 'string'],
            [['status', 'category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'main_image', 'alias'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['upload_image'], 'file', 'extensions' => 'png, jpg'],
            [['upload_preview_image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'lead' => 'Первый абзац',
            'body' => 'Текст',
            'main_image' => 'Главное изображение',
            'preview_image' => 'Превью изображения',
            'status' => 'Статус',
            'category_id' => 'ID Категории',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
            'upload_image' => 'Главное изображение',
            'upload_preview_image' => 'Превью изображение',
            'alias' => 'Псевдоним заголовка'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    //связь с таблицей Categories
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
    
    public function getNews($param, $offset = 0){
        
       return self::find()->andWhere(['category_id' => $param])->andWhere(['status' => 1])->orderBy(['created_at' => SORT_DESC])->offset($offset)->limit(12)->all();
    }
    
    public static function getMainImage($image){
        
        return '/web/uploads/'.$image;
    }
    
    public static function getPreviewImage($image){
        
        return '/web/uploads/preview/'.$image;
    }
    
    public static function getNoPreviewImage(){
        
        return '/web/public/no_image.png';
    }
    
    public static function getDate($date){
        
        $date_arr = explode(" ", $date);
        $new_date_arr = explode("-", $date_arr[0]); 
        $date_str = $new_date_arr[2] . '.' . $new_date_arr[1] . '.' . $new_date_arr[0];
        
        return $date_str;
    }
    
    public function getOneArticles($id){
        
        $article = self::findOne($id);
        
        return $article;
    }
    
    public function getLastArticles($category_id, $id=0){
        
        return self::find()->andWhere(['category_id' => $category_id])->andWhere(['status' => 1])->andWhere(['!=', 'id', $id])->orderBy(['created_at' => SORT_DESC])->limit(5)->all();
    }
    
    public function getOneArticleByCategoryId($category_id){
        
        return self::find()->andWhere(['category_id' => $category_id])->andWhere(['status' => 1])->one();
    }

    public function getArticleByAlias($alias) {
        
        return self::find()->where(['alias' => $alias, 'status' => 1])->one(); 
    }
    
    public function getSelectData($arr){
        
        return self::find()->andWhere(['in', 'id', $arr])->andWhere(['status' => 1])->all();
    }
    
    public function getArticlesByCategoryId($category_id, $id=0){
        
        return self::find()->andWhere(['category_id' => $category_id, 'status' => 1])->andWhere(['!=', 'id', $id])->all();
    }

    public function getOneArticleByCategoryIdAndAlias($category_id){
        
        return self::find()->where(['category_id' => $category_id, 'status' => 1, 'alias' => '/'])->one();
    }
    
    public function getCategoryArticlesByCategoryIdAdnAlias($category_id){
        
        return self::find()->andWhere(['category_id' => $category_id, 'status' => 1])->andWhere(['!=', 'alias', '/'])->all();
    }
    //обрезка и составление строки для breadcrumbs
     public static function cutArticleTitle($title)
    {
        if($title){
            $arr_title = explode(' ', $title, 6);
            
            if(count($arr_title) > 5){
                array_pop($arr_title);
            }
            
            for($i=0; $i<count($arr_title); $i++){
                if($i == (count($arr_title)-1)){
                    $str .= $arr_title[$i] . '...';
                }
                else{
                    $str .= $arr_title[$i] . ' ';
                }
            }
            return $str;
        }
    }
    //запрос для поиска
    public static function getSearchArticles($query, $offset)
    {
        return self::find()->where(['status' => 1])->andWhere(['like', 'body', $query])->orWhere(['like', 'lead', $query])->orderBy(['created_at' => SORT_DESC])->offset($offset)->limit(9)->all();
        
    }
    
    public static function getSearchArticlesCount($query)
    {
        return self::find()->where(['status' => 1])->andWhere(['like', 'body', $query])->orWhere(['like', 'lead', $query])->count();
    }
    
    public static function cutArticleLeadOrBody($data)
    {
        if($data){
            $data = substr($data, 0, 350);
            
            
            return ($data.'...');
        }
    }
}
