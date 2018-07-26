<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Slider1 */

$this->title = 'Создать изображение для Слайдера1';
$this->params['breadcrumbs'][] = ['label' => 'Слайдер1', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'no_image' => $no_image
    ]) ?>

</div>
