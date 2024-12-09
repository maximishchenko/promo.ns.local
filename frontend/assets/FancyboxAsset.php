<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class FancyboxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/fancybox.css',
    ];
    public $js = [
        '/js/fancybox.umd.js',
    ];
    public $depends = [
    ];
    public $cssOptions = [
        'media' => "print",
        'onload' => "this.media='all'; this.onload = null",
    ];
}
