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

$carousel = Slider1::getCarousel();

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
   
    <div class="container wrap-content">
        <!--start Навигация-->
        <nav>
            <?php require 'assets/main_nav.php'; ?>
        </nav>
        <!--end Навигация-->
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
    
    <div class="container up-footer">
        <!--start footer-->
         <footer class="footer">
            <div class="footer-wrap">
                <div class="logo-footer">
                    <a href="/"><img src="/public/logo_KosKom.png" /></a>
                </div>
                <p class="footer-title">&copy;&nbsp;<?= date('Y') ?>&nbsp;АО «Российские космические системы»</p>
            </div>
        </footer>
        <!--end footer-->
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
