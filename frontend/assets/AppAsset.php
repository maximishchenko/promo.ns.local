<?php

namespace frontend\assets;

use yii\web\AssetBundle;


class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
        'css/style.css',
    ];
    public $js = [
        'js/PhoneMaskInputRus.min.js',
        'js/app.js',
        'js/scripts.js'
    ];
    public $depends = [
        'frontend\assets\NpmAsset',
        'frontend\assets\FancyboxAsset',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
        'defer' => 'defer',
    ];
}
