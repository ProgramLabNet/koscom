<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadImage extends Model{
    
    
    public $imageFile;
    //копия названия файла для записи в БД
    public $imageFileToDb;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '_'. time() . '.' . $this->imageFile->extension);
            $this->imageFileToDb = $this->imageFile->baseName . '_'. time() . '.' . $this->imageFile->extension;
            return true;
        } else {
            return false;
        }
    }
}
