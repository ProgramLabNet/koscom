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

    <div class="container wrap-content">
        <!--start Навигация-->
        <nav>
            <?php require 'assets/main_nav.php'; ?>
        </nav>
        <!--end Навигация-->

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
