<?php
    use app\models\Articles;
    use yii\helpers\Url; 
?>

<div class="ctegory_panel">
    <span>Новости</span>
</div>
<div id="content_in_content">
    <div class="row">
        <?php 
                if($news): 
                    foreach($news as $one_news):
        ?>
            <div class="col-lg-3 news-cols">
                <div class="news-size">
                    <div class="news-image"><a  class="link-img" href="<?= Url::toRoute(['article', 'id' => $one_news->id]) ?>"><div class="img-hover"></div><img src="<?= ($one_news->preview_image) ? Articles::getPreviewImage($one_news->preview_image) : Articles::getNoPreviewImage() ?>" alt=""></a></div>
                    <div class="news-text">
                        <span class="news-title"><a href="<?= Url::toRoute(['article', 'id' => $one_news->id]) ?>"><?= $one_news->title ?></a></span>
                        <span class="news-created">Новости&nbsp&nbsp&ndash;&nbsp&nbsp<?= Articles::getDate($one_news->created_at) ?></span>
                        <span class="news-more"><a href="<?= Url::toRoute(['article', 'id' => $one_news->id]) ?>">Подробнее...</a></span>
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
</div>