<?php
    use app\models\Articles;
    use yii\helpers\Url; 
?>

<div class="ctegory_panel ctegory_panel_news">
    <span>Новости</span>
</div>
<div class="row">
    <?php 
        if($news): 
            foreach($news as $one_news):
    ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 news-cols">
            <div class="news-size">
                <div class="news-image">
                    <a  class="link-img" href="<?= Url::toRoute(['/news', 'alias' => $one_news->alias]) ?>">
                        <div class="wrap-img">
                            <div class="img-opacity"></div>
                            <img src="<?= ($one_news->preview_image) ? Articles::getPreviewImage($one_news->preview_image) : Articles::getNoPreviewImage() ?>" alt="" />
                        </div>
                    </a>
                </div>
                <div class="news-text">
                    <span class="news-title"><a href="<?= Url::toRoute(['/news', 'alias' => $one_news->alias]) ?>"><?= $one_news->title ?></a></span>
                    <div class="wrap-bottom-spans">
                        <span class="news-created">Новости&nbsp&nbsp&ndash;&nbsp&nbsp<?= Articles::getDate($one_news->created_at) ?></span>
                        <span class="news-more"><a href="<?= Url::toRoute(['/news', 'alias' => $one_news->alias]) ?>">Подробнее...</a></span>
                    </div>
                </div>
            </div>
        </div>
    <?php 
            endforeach;
        endif;
        if(!$news){
            echo $this->render('@app/views/static/NoData.php');
        }
    ?>
</div>