<?php
    use app\models\Articles;
    use yii\helpers\Url;
    use yii\widgets\Breadcrumbs;
    use app\models\Categories;
    use yii\widgets\LinkPager;
?>
<?php if($search_query): ?>
    <div class="ctegory_panel">
        <span>Результаты поиска для: <?= $query ?></span>
        <div class="wrap-breadcrumbs">
            <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <!--start left block-->
        <?php foreach($search_query as $search): ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 searc-view">
            <div class="search-back">
                <div class="search-content">
                    <div class="search-title">
                        <a href="<?= Url::toRoute([Categories::getUrlById($search->category_id), 'alias' => ($search->alias != '/') ? $search->alias : null ]) ?>"><?= $search->title ?></a>
                    </div>
                    <?php if($search->preview_image): ?>
                        <div class="search-image">
                            <a href="<?= Url::toRoute([Categories::getUrlById($search->category_id), 'alias' => ($search->alias != '/') ? $search->alias : null ]) ?>">
                                <div class="search-hover-wrap">
                                    <div class="search-hover"></div>
                                    <img src="<?= Articles::getPreviewImage($search->preview_image)?>"/>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($search->lead): ?>
                        <div class="search-cut-text">
                            <?= Articles::cutArticleLeadOrBody($search->lead) ?>
                        </div>
                    <?php else: ?>
                        <div class="search-cut-text">
                            <?= Articles::cutArticleLeadOrBody($search->body) ?>
                        </div>
                    <?php endif; ?>
                    <div class="search-more">
                        <a href="<?= Url::toRoute([Categories::getUrlById($search->category_id), 'alias' => ($search->alias != '/') ? $search->alias : null ]) ?>">Перейти...</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <!--end left block-->
    </div>
    <?php if($count && ($count > 1)): ?>
        <div class="search-pager">
            <ul>
                <?php if($page != 1): ?>
                    <li><a href="<?= Url::toRoute(['/search/index', 'page' => $page-1, 'query' => $query]) ?>"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                <?php endif; ?>
                <?php for($i=$j; $i <= $count; $i++):?>
                    <li>
                        <a class="<?= ($i == $page) ? 'pager-activ' : '' ?>" href="<?= Url::toRoute(['/search/index', 'page' => $i, 'query' => $query]) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <?php if(($page) != $total_count): ?>
                    .&nbsp;.&nbsp;.
                    <li><a href="<?= Url::toRoute(['/search/index', 'page' => $total_count, 'query' => $query ]) ?>"><?= $total_count ?></a></li>
                    <li><a href="<?= Url::toRoute(['/search/index', 'page' => ($page) ? $page+1 : 2, 'query' => $query]) ?>"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>

<?php else: ?>
    <?= '<h3>Ничего нет по запросу: '.$query.'!</h3>' ?>
<?php endif; ?>
