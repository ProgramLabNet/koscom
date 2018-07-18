<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\NewsAsset;
use app\models\Categories;

NewsAsset::register($this);
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
        
        <!--start Панель для админа-->
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
        <!--end Панель для админа-->
        
        <!--start Панель для пользователя-->
        <div class="container for-users">
            <ul class="navbar-nav navbar-left nav main-menu">
                <?php foreach(Categories::getCategoriesForNavMenu() as $key=>$nav):?>
                    <li><a href="<?= Url::toRoute([$nav['url']])?>"><?= $nav['name']?></a>
                        <?php if($nav['children']): ?>
                            <ul class="sub-menu">
                                <?php foreach($nav['children'] as $k_sub_nuv => $v_sub_nav): ?>
                                    <li><a href="#"><?= $v_sub_nav['name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--end Панель для пользователя-->
    </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
            <?= $content ?>
        
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
