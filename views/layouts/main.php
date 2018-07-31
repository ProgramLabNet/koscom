<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Categories;
use yii\bootstrap\Carousel;
use app\models\Slider1;

$carousel = (Slider1::getCarousel());

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
        
        <!--start Навигация-->
        <nav>
            <div class="nav-header">
                <div class="mini-logo">
                    <a class="nav-header-link" href="/"><img src="/public/logo_KosKom.png" /></a>
                </div>
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
            <?php if(Categories::getCategoriesForNavMenu()['else_arr']): ?>    
                <div class="for-users">
                    <div class="logo">
                        <a class="nav-header-link" href="/"><img src="/public/logo_KosKom.png" /></a>
                    </div>
                    <!--start главного меню-->
                    <ul class="main-menu">
                        <?php foreach(Categories::getCategoriesForNavMenu()['else_arr'] as $key=>$nav):?>
                            <!--start кнопка ещё-->
                            <?php if($key === 'else'): ?>
                                <li class="else"><a href="#">ЕЩЁ&nbsp;<span class="glyphicon glyphicon-chevron-down"></span></a>
                                    <ul class="else-menu">
                                        <?php foreach($nav as $else): ?>
                                            <li><a href="<?= Url::toRoute([$else['url']])?>"><?= $else['name']?></a>
                                                <?php if($else['children']): ?>
                                                    <ul class="sub-menu">
                                                        <?php foreach($else['children'] as $k_sub_nuv_else => $v_sub_nav_else): ?>
                                                            <li><a href="<?= $v_sub_nav_else['url']; ?>"><?= $v_sub_nav_else['name']; ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                            <!--end кнопка ещё-->
                                <li><a href="<?= Url::toRoute([$nav['url']])?>"><?= $nav['name']?></a>
                                    <?php if($nav['children']): ?>
                                        <ul class="sub-menu">
                                            <?php foreach($nav['children'] as $k_sub_nuv => $v_sub_nav): ?>
                                                <li><a href="<?= $v_sub_nav['url']; ?>"><?= $v_sub_nav['name']; ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <!--end главного меню-->
                    <ul class="mini-menu">
                        <?php foreach(Categories::getCategoriesForNavMenu()['whithout_else_arr'] as $key=>$nav):?>
                        
                            <li><a href="<?= Url::toRoute([$nav['url']])?>"><?= $nav['name']?></a>
                                <?php if($nav['children']): ?>
                                    <ul class="sub-menu">
                                        <?php foreach($nav['children'] as $k_sub_nuv => $v_sub_nav): ?>
                                            <li><a href="<?= $v_sub_nav['url']; ?>"><?= $v_sub_nav['name']; ?></a></li>
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
        <!--end Навигация-->
        
        <div class="wrap-content">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?php if($carousel): ?>
            <div id="main-slider">
                <?= Carousel::widget([
                    'items' => $carousel,
                    'options' => ['class' => 'carousel slide', 'data-interval' => '5000'],
                    'controls' => [
                    '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
                    '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
                    ]
               ]);?>
            </div>
            <?php endif; ?>
            
            <div id="content_in_content">
                <?= $content ?>
            </div>
            
        </div>
    </div>
</div>

<!--start footer-->
<div class="container">
    <footer class="footer">
            <div class="footer-wrap">
                <div class="logo-footer">
                    <a href="/"><img src="/public/logo_KosKom.png" /></a>
                </div>
                <p class="footer-title">&copy;&nbsp;<?= date('Y') ?>&nbsp;АО «Российские космические системы»</p>
            </div>
    </footer>
</div>
<!--end footer-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
