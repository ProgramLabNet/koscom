<?php
    use app\models\Articles;
    use yii\helpers\Url; 
?>
<div class="article-bar">
    <?php if($lastArticles): ?>
        <div class="article-last-news">
            <span class="article-bar-title">Последние новости</span>
            <?php foreach($lastArticles as $lastArticle): ?>
                <div>
                    <div>
                        <span><a href="<?= Url::toRoute(['news/article', 'alias' => $lastArticle->alias]) ?>"><?= $lastArticle->title ?></a></span>
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
