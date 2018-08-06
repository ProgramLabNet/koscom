<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mainpage".
 *
 * @property int $id
 * @property int $article_id
 * @property string $article_link
 * @property int $status
 * @property string $created_at
 */
class Mainpage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mainpage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['created_at', 'default', 'value' => date('Y-m-d H:i:s')],
            [['article_id', 'status'], 'required'],
            [['article_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'ID Статьи',
            'article_link' => 'Ссылка для статьи',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
        ];
    }
    
    public function getDataForMainPage(){
        
        $results = self::find()->where(['status' => 1])->limit(6)->all();
        
        if($results){
            foreach($results as $result){
                $exit_arr[] = $result->article_id;
            }
        }
        
        return $exit_arr;
    }
}
