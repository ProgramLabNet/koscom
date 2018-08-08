<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
        <div class="nav-admin">
            <?php
            NavBar::begin([
                'brandLabel' => 'Панель администратора',
                'brandUrl' => Yii::$app->homeUrl,
                'renderInnerContainer' => true,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Главная', 'url' => ['/site']],

                    /*!Yii::$app->user->isGuest ?
                    ['label' => 'Рестрация', 'url' => ['/admin/default/signup']]:
                        ['label' => ''],*/

                    !Yii::$app->user->isGuest ?
                    ['label' => 'Admin', 'url' => ['/admin/default/index']]:
                        ['label' => ''],

                    Yii::$app->user->isGuest ? 
                        ['label' => 'Войти', 'url' => ['/login']] : 
                            ['label' => 'Выйти ('.Yii::$app->user->identity->username.')', 'url' => ['/login/logout'], 'post'],
                ],
            ]);
            NavBar::end();
            ?>
        </div>
        <div class="content_in_content_admin">

            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Admin', 'url' => '/admin/default/index'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>

            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
