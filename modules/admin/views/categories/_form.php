<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($parent_id) ?>

    <?= $form->field($model, 'level')->dropDownList([1 =>1, 2=>2, 3=>3, 4=>4]) ?>

    <?= $form->field($model, 'status')->dropDownList([1=>'Активный', 0=>'Не активный']) ?>
    
    <?= $form->field($model, 'position')->textInput() ?>
    
    <?= $form->field($model, 'url')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
