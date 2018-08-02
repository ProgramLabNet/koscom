<?php
    use app\models\Articles;
    use yii\helpers\Url; 
?>
<?php if($article): ?>
    <div class="ctegory_panel">
        <span><?= $article->title ?></span>
    </div>

    <div id="content_in_content">
        <div class="row">
            <div class="article-wrap">
                <!--start left block-->
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="article-main">
                        <?php if($article->main_image): ?>
                            <div class="article-image">
                                <img src="<?= Articles::getMainImage($article->main_image) ?>">
                            </div>
                        <?php endif; ?>
                        <?php if($article->lead): ?>
                            <div class="article-lead">
                                <?= $article->lead ?>
                            </div>
                        <?php endif; ?>
                        <div class="article-body">
                            <?= $article->body ?>
                        </div>
                    </div>
                </div>
                <!--end left block-->
                
                <!--start right block-->
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $this->render('/layouts/assets/right_article_bar.php', [
                        'lastArticles' => $lastArticles,
                        'brothersCategories' => $brothersCategories
                    ]) ?>
                </div>
                <!--end right block-->
            </div>
        </div>
    </div>
<?php else: ?>
    <?= $this->render('/static/404.php') ?>
<?php endif; ?>

