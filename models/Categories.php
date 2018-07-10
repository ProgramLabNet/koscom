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
            [['parent_id', 'level', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    
    public function getParentId()
    {
        $parent_id = [0 => 'Без родиделя'];
        
        if($categories = self::find()->where(['parent_id' => 0])->all()){
            $parent_id_db = ArrayHelper::map($categories,'id','name');
            
            foreach($parent_id_db as $key => $item){
                $parent_id[$key] = $item;
            }
        }
        return $parent_id;
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
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
        ];
    }
}
