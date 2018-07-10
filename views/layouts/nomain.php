<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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
    
    <nav class="navbar navbar-default navbar-fixed-top container navbar-main" role="navigation"> 
        <div class="container for-admin">
            <ul class="navbar-nav navbar-right nav">
                <?php if(Yii::$app->user->isGuest): ?>
                    <li><a href="<?= Url::toRoute(['/login']); ?>">ВОЙТИ</a></li>
                <?php endif; ?>
                <?php if(!Yii::$app->user->isGuest): ?>
                    <li><a href="<?= Url::toRoute(['/admin/default/index']); ?>">ADMIN</a></li>
                    <li><a href="<?= Url::toRoute(['/login/logout']); ?>">ВЫЙТИ<?= '('.Yii::$app->user->identity->username.')'?></a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="container for-users">
            <ul class="navbar-nav navbar-left nav main-menu">
                <li><a href="<?= Url::toRoute(['/']); ?>">ГЛАВНАЯ</a></li>
                <li><a href="<?= Url::toRoute(['/news']); ?>">НОВОСТИ</a></li>
                <li><a href="#">ФЕДЕРАЛЬНЫЙ СЕТЕВОЙ ОПЕРАТОР</a>
                    <ul class="sub-menu">
                        <li><a href="#">Описание</a></li>
                        <li><a href="#">Нормативная документация</a></li>
                        <li><a href="#">История</a></li>
                    </ul>
                </li>
                <li><a href="#">СЕРВИСЫ ИФСО</a>
                    <ul class="sub-menu">
                        <li><a href="#">Перечень сервисов с описаниями</a></li>
                        <li><a href="#">Принципы работы ИФСО</a></li>
                        <li><a href="#">Взаимодействие с разработчиками</a></li>
                        <li><a href="#">Создание нового сервиса</a></li>
                        <li><a href="#">Истории успеха</a></li>
                    </ul>
                </li>
                <li><a href="<?= Url::toRoute(['/results']); ?>">РЕЗУЛЬТАТЫ КОСМИЧЕСКОЙ ДЕЯТЕЛЬНОСТИ</a></li>
                <li><a href="<?= Url::toRoute(['/contacts']); ?>">КОНТАКТЫ</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div id="content_in_content">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
