<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/backend.css',
        'css/sortable.css',
        'libs/bootstrap-datepicker.min.css',
    ];
    public $js = [        
        'js/jquery-ui.js',
        // 'js/sortable.js',
        'libs/bootstrap-datepicker.min.js',
        'libs/bootstrap-datepicker.ru.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];    
    public $jsOptions = [
        'position'=>\yii\web\View::POS_HEAD
    ];

}
