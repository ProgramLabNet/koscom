<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lead')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'body')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>
    
    
    <?php 
        if(($model->id) && ($model->main_image)): 
    ?>
        <div class="upload_image_main">
            <div class="control-label">Уже загруженное главное изображение:</div>
            <span class="upload_from_db"><img src="/web/uploads/<?= $model->main_image?>"></span><span class="field_from_db"><?= $model->main_image ?></span>
        </div >
    <?php
        endif;
    ?>
    
    <?= $form->field($model, 'upload_image')->fileInput() ?>
        
    <?php 
        if(($model->id) && ($model->preview_image)): 
    ?>
        <div class="upload_image_main">
            <div class="control-label">Уже загруженное превью изображение:</div>
            <span class="upload_from_db_preview"><img src="/web/uploads/preview/<?= $model->preview_image?>"></span><span class="field_from_db"><?= $model->preview_image ?></span>
        </div >
    <?php
        endif;
    ?>
        
    <?= $form->field($model, 'upload_preview_image')->fileInput() ?>    

    <?= $form->field($model, 'status')->dropDownList([1=>'Активный', 0=>'Не активный']) ?>

    <?= $form->field($model, 'category_id')->dropDownList($arr_categories) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
