<?php
    use app\models\Articles;
    use app\models\Categories;
    use yii\helpers\Url; 
?>
<div class="article-bar">
    <?php if($category_article): 
        ?>
        <div class="article-last-news">
            <?php foreach($category_article as $k_article => $article): ?>
                <div>
                    <div>
                        <span><a href="<?= Url::toRoute([Categories::getUrlById($article->category_id), 'alias' => $article->alias ]) ?>"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<?= $article->title ?></a></span>
                        <?php if(count($category_article) !== ($k_article + 1)): ?>
                            <span class="article-bar-rubrika"></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if($lastArticles): ?>
        <div class="article-last-news">
            <span class="article-bar-title">Последние новости</span>
            <?php foreach($lastArticles as $lastArticle): ?>
                <div>
                    <div>
                        <span><a href="<?= Url::toRoute(['news/article', 'alias' => (($lastArticle->alias ) ? $lastArticle->alias : null) ]) ?>"><?= $lastArticle->title ?></a></span>
                    </div>
                    <div>
                        <span><?= Articles::getDate($lastArticle->created_at) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
