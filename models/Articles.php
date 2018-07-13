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
            [['title', 'body', 'status', 'category_id', 'created_at'], 'required'],
            [['lead', 'body'], 'string'],
            [['status', 'category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'main_image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['upload_image'], 'file', 'extensions' => 'png, jpg'],
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
            'main_image' => 'Изображение',
            'status' => 'Статус',
            'category_id' => 'ID Категории',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
