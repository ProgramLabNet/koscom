<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "slider1".
 *
 * @property int $id
 * @property string $image
 * @property string $link
 * @property int $sttus
 * @property string $created_at
 */
class Slider1 extends \yii\db\ActiveRecord
{
    //введено дополнительное свойство для загрузки изображения из формы
    public $upload_image;
    
    const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['created_at', 'default', 'value' => date('Y-m-d H:i:s')],
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['link'], 'string', 'max' => 255],
            [['link', 'status'], 'required'],
            [['upload_image'], 'file', 'extensions' => 'png, jpg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'upload_image' => 'Выбрать изображение',
            'link' => 'Ссылка',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
        ];
    }
    
    //сценарий для полей редактирования модели User
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        
        $scenarios[self::SCENARIO_UPDATE] = ['link', 'status'];
        
        return $scenarios;
    }
    
    public static function getCarousel()
    {
        $model_carousel = self::find()->where(['status' => 1])->all();
        
        $carousel = [];
        
        if($model_carousel)
        {
            foreach($model_carousel as $key=>$carousels){
                $carousel[$key]['content'] = "<img src='@/web/uploads/slider1/".$carousels['image']."/>";
                $carousel[$key]['caption'] = '<a href="news/article?id=11"><h2>Заголовок</h2></a>';
                $carousel[$key]['options'] = [];
            }
        }
        
       return $carousel;
    }
}
