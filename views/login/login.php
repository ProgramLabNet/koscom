<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */
?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-3"></div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-help">

                <h2>Вход на сайт</h2>

                <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'username_or_email')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <button type="submit" class="button-help">Отправить</button>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-3"></div>
    </div>
</div>
