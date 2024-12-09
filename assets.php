<?php

Yii::setAlias('@webroot', __DIR__ . '/frontend/web');
Yii::setAlias('@web', '/');

return [
    'jsCompressor' => 'gulp compress-js --gulpfile gulpfileTask.js --src {from} --dist {to}',
    'cssCompressor' => 'gulp compress-css --gulpfile gulpfileTask.js --src {from} --dist {to}',
    'deleteSource' => false,
    'bundles' => [
        'frontend\assets\AppAsset',
        'frontend\assets\FancyboxAsset',
    ],
    'targets' => [
        'all' => [
            'class' => 'frontend\assets\AppAsset',
            'basePath' => '@webroot/',
            'baseUrl' => '@web/',
            'jsOptions' => [
                'defer' => 'defer',
            ],
            // 'js' => 'assets/all.min.js',
            // 'css' => 'assets/all.min.css',
            'js' => 'assets/all-{hash}.min.js',
            'css' => 'assets/all-{hash}.min.css',
            'depends' => [
                'frontend\assets\AppAsset',
                'frontend\assets\FancyboxAsset',
                'frontend\assets\NpmAsset',
            ],
        ],
    ],
    // Asset manager configuration:
    'assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
        'linkAssets' => true,
        'appendTimestamp' => true,
        'bundles' => [
            'yii\web\JqueryAsset' => false,
            'yii\bootstrap\BootstrapPluginAsset' => false,
            'yii\bootstrap\BootstrapAsset' => false,
            'yii\web\YiiAsset' => false,
            'yii\widgets\ActiveFormAsset' => false,
        ],
    ],
];