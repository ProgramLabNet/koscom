<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Slider1 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider1-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'upload_image')->fileInput() ?>
    
    
    <?php if($no_image): ?>
        <div class="form-error">
            <?=  $no_image ?>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([1=>1, 0=>0]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
