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
use app\models\Categories;

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
    <div class="container">   
        <nav>
            <div class="nav-header">
                <a class="nav-header-link" href="/">РКС</a>
                <button type="button" class="nav-header-button">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </button>
            </div>
            <!--start Панель для админа-->
            <div class="for-admin">
                <ul>
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
            <?php if(Categories::getCategoriesForNavMenu()): ?>    
                <div class="for-users">
                    <ul class="main-menu">
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
            <?php else: ?>
                <div class="for-users no-categories"></div>
            <?php endif; ?>
            <!--end Панель для пользователя-->
        </nav>
        
        <div class="wrap-content">
            <?= $content ?>
        </div>
    </div>
</div>

<div class="container">
    <footer class="footer">
        <p class="pull-left">&copy;&nbsp;<?= date('Y') ?>&nbsp;АО «Российские космические системы»</p>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
