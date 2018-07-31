<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Slider1 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Слайдер1', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider1-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить это изображение?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'image',
            'link',
            'title',
            'status',
            'created_at',
        ],
    ]) ?>

</div>
