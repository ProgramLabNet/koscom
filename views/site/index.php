<?php
    use yii\helpers\Url;
    use app\models\Categories;
    use app\models\Articles;
    
?>

<div class="row">
    <?php if($articles_arr): ?>
        <?php foreach($articles_arr as $article):?>
            <div class="col-lg-6 col-sm-6 col-sm-12 main-padding">
                <div class="main-image">
                    <div class="main-page-link-wrap">
                        <a href="<?= Url::toRoute([ Categories::getUrlById($article->category_id)]) ?>"><?= $article->title ?></a>
                    </div>
                    <a href="<?= Url::toRoute([ Categories::getUrlById($article->category_id)]) ?>">
                        <div class="img-opacity"></div>
                        <img src="<?= ($article->preview_image) ? Articles::getPreviewImage($article->preview_image) : Articles::getNoPreviewImage() ?>" alt="">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>