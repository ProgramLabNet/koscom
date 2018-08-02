<?php

namespace app\controllers;

class ContactsController extends \yii\web\Controller
{
    public $layout = 'nomain';
    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
