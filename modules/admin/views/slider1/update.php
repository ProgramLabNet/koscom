<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Slider1 */

$this->title = 'Редактировать Слайдер1: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Слайдер1', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="slider1-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
