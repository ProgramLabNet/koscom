<?php

namespace app\controllers;

class ContactsController extends \yii\web\Controller
{
    public $layout = 'nomain';
    
    public function actionIndex()
    {
        $this->view->title = 'Контакты';
        return $this->render('index');
    }

}
