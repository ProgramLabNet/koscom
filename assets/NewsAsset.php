<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of NewsAsset
 *
 * @author progr
 */
class NewsAsset extends AssetBundle{
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/main.css',
        'css/help.css',
        'css/nomain.css',
        'public/css/electralightpro.css',
        'public/css/electrolightprobold.css'
    ];
    public $js = [
        'js/news.js',
        'js/nav.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
