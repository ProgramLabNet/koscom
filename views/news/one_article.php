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
                <div class="col-lg-8">
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
                <div class="col-lg-4">
                    <div class="article-bar">
                        <?php if($lastArticles): ?>
                            <div class="article-last-news">
                                <span class="article-bar-title">Последние новости</span>
                                <?php foreach($lastArticles as $lastArticle): ?>
                                    <div>
                                        <div>
                                            <span><a href="<?= Url::toRoute(['news/article', 'id' => $lastArticle->id]) ?>"><?= $lastArticle->title ?></a></span>
                                        </div>
                                        <div>
                                            <span><?= Articles::getDate($lastArticle->created_at) ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if($brothersCategories): ?>
                            <div class="article-last-news">
                                <span class="article-bar-title">Похожие рубрики</span>
                                <?php foreach($brothersCategories as $brothersCategory): ?>
                                    <div>
                                        <div>
                                            <span><a href="<?= $brothersCategory->url ?>"><?= $brothersCategory->name ?></a></span>
                                            <span class="article-bar-rubrika"></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!--end right block-->
            </div>
        </div>
    </div>
<?php else: ?>
    <?= $this->render('/static/404.php') ?>
<?php endif; ?>

