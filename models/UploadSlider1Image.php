<?php

namespace app\models;

use yii\base\Model;


class UploadSlider1Image extends Model{
    //изображение
    public $slider1Image;
    //изображение в БД
    public $slider1ImageToDb;
    
    
    public function upload()
    {
        if ($this->slider1Image->baseName) {
            $image_name = $this->slider1Image->baseName . '_'. time() . '.' . $this->slider1Image->extension;
            $image_path = 'uploads/slider1/' . $image_name;
            $this->slider1Image->saveAs($image_path);
            $this->slider1ImageToDb = $image_name;
        }
        
        if($this->slider1ImageToDb){
            return true;
        } else {
            return false;
        }
    }
}
