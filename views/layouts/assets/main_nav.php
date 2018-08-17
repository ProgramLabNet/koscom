<?php
use app\models\Categories;
use app\models\Articles;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\SearchForm;

$model_searh = new SearchForm();
?>

<div class="nav-header">
    <div class="mini-logo">
        <a class="nav-header-link" href="/"><img src="/public/logo_KosKom.png" /></a>
    </div>
    <button type="button" class="nav-header-button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
    </button>
</div>
    <!--start Панель для админа-->
<div class="for-admin">
    <ul  class="admin-mail">
        <li><span class="glyphicon glyphicon-envelope"></span>&nbsp;info@kos-com.ru</li>
    </ul>
    <ul>
        <?php if(Yii::$app->user->isGuest): ?>
            <li><a href="<?= Url::toRoute(['/login']); ?>">ВОЙТИ</a></li>
            <li><span class="glyphicon glyphicon-search "></span><span class="search-sp">ПОИСК</span></li>
                <ul id="search">
                    <li>
                        <?php $form = ActiveForm::begin(['action' => ['search/index']]); ?>
                            <?= $form->field($model_searh, 'query')->textInput(['class' => 'input-search', 'placeholder' => "Нажмите Enter", 'autocomplete' => "off"])->label('') ?>
                        <?php ActiveForm::end(); ?>
                    </li>
                </ul>
        <?php endif; ?>
        <?php if(!Yii::$app->user->isGuest): ?>
            <li><a href="<?= Url::toRoute(['/admin/default/index']); ?>">ADMIN</a></li>
            <li><a href="<?= Url::toRoute(['/login/logout']); ?>">ВЫЙТИ<?= '('.Yii::$app->user->identity->username.')'?></a></li>
            <li><span class="glyphicon glyphicon-search "></span><span class="search-sp">ПОИСК</span></li>
                <ul id="search">
                    <li>
                        <?php $form = ActiveForm::begin(['action' => ['search/index']]); ?>
                            <?= $form->field($model_searh, 'query')->textInput(['class' => 'input-search', 'placeholder' => "Нажмите Enter", 'autocomplete' => "off"])->label('') ?>
                        <?php ActiveForm::end(); ?>
                    </li>
                </ul>
        <?php endif; ?>
    </ul>
</div>
<!--end Панель для админа-->
<!--start Панель для пользователя-->
<?php if(Categories::getCategoriesForNavMenu()['else_arr']): ?>    
    <div class="for-users">
        <div class="logo">
            <a class="nav-header-link" href="/"><img src="/public/logo_KosKom.png" /></a>
        </div>
        <!--start главного меню-->
        <ul class="main-menu">
            <?php foreach(Categories::getCategoriesForNavMenu()['else_arr'] as $key=>$nav):?>
                <!--start кнопка ещё-->
                <?php if($key === 'else'): ?>
                    <li class="else"><a class="main-parent" href="">ЕЩЁ&nbsp;<span class="glyphicon glyphicon-chevron-down"></span></a>
                        <ul class="else-menu">
                            <?php foreach($nav as $else): ?>
                            <li><a class="main-parent" href="<?= Url::toRoute([$else['url']]) ?>"><?= $else['name']?></a>
                                    <?php if($else['children']): ?>
                                        <ul class="sub-menu">
                                            <?php foreach($else['children'] as $k_sub_nuv_else => $v_sub_nav_else): ?>
                                                <li><a href="<?= Url::toRoute([$v_sub_nav_else['url']]) ?>"><?= $v_sub_nav_else['name'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                <!--end кнопка ещё-->
                    <li><a class="main-parent" href="<?= Url::toRoute([$nav['url']]) ?>"><?= $nav['name'] ?></a>
                        <?php if($nav['children']): ?>
                            <ul class="sub-menu">
                                <?php foreach($nav['children'] as $k_sub_nuv => $v_sub_nav): ?>
                                    <li><a href="<?= Url::toRoute([$v_sub_nav['url']]) ?>"><?= $v_sub_nav['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <!--end главного меню-->
        <ul class="mini-menu">
            <?php foreach(Categories::getCategoriesForNavMenu()['whithout_else_arr'] as $key=>$nav):?>
                <li><a class="main-parent" href="<?= Url::toRoute([$nav['url']])?>"><?= $nav['name']?></a>
                    <?php if($nav['children']): ?>
                        <ul class="sub-menu">
                            <?php foreach($nav['children'] as $k_sub_nuv => $v_sub_nav): ?>
                                <li><a href="<?= Url::toRoute([$v_sub_nav['url']]) ?>"><?= $v_sub_nav['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <div class="for-users no-categories"></div>
<?php endif; ?>
<!--end Панель для пользователя-->
