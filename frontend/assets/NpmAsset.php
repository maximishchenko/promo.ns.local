<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class NpmAsset extends AssetBundle
{
    public $sourcePath = '@npm';
    public $css = [
        'swiper/swiper-bundle.min.css',
        'ion-rangeslider/css/ion.rangeSlider.min.css',
    ];
    public $js = [
        'jquery/dist/jquery.min.js',
        'swiper/swiper-bundle.min.js',
        'ion-rangeslider/js/ion.rangeSlider.min.js',
    ];
    public $depends = [
    ];
    public $jsOptions = [
        // 'position' => \yii\web\View::POS_HEAD,
        // 'defer' => 'defer',
    ];

}