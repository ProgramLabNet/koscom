<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadImage extends Model{
    
    //Главное изображение
    public $imageFile;
    //копия названия файла для записи в БД
    public $imageFileToDb;
    //preview изображение
    public $previewImageFile;
    //копия названия файла preview для записи в БД
    public $previewImageFileToDb;
    
    public function upload()
    {
        if ($this->imageFile->baseName) {
            $image_name = $this->imageFile->baseName . '_'. time() . '.' . $this->imageFile->extension;
            $image_path = 'uploads/' . $image_name;
            $this->imageFile->saveAs($image_path);
            $this->imageFileToDb = $image_name;
        }
        if($this->previewImageFile->baseName){
            $image_preview_name = $this->previewImageFile->baseName . '_preview_' . time() . '.' . $this->previewImageFile->extension;
            $image_preview_path = 'uploads/preview/' . $image_preview_name;
            $this->previewImageFile->saveAs($image_preview_path);
            $this->previewImageFileToDb = $image_preview_name;
        }
        
        if($this->imageFileToDb || $this->previewImageFileToDb){
            return true;
        } else {
            return false;
        }
    }
}
