<?php
$this->title = Yii::$app->name;
$this->params['breadcrumbs'] = [['label' => $this->title]];

?>
<div class="container-fluid"> 

    <div class="row">
        <div class="col-12">
            <h1><?= Yii::t('app', 'MANAGEMENT_MODULE'); ?></h1>
            <hr>
        </div>
    </div>
    <?= $this->render('//layouts/dashboard/_management_dashboard_items'); ?>  

    <div class="row">
        <div class="col-12">
            <h1><?= Yii::t('app', 'CATALOG_MODULE'); ?></h1>
            <hr>
        </div>
    </div>
    <?= $this->render('//layouts/dashboard/_catalog_dashboard_items'); ?>

    <div class="row">
        <div class="col-12">
            <h1><?= Yii::t('app', 'CONTENT_MODULE'); ?></h1>
            <hr>
        </div>
    </div>    
    <?= $this->render('//layouts/dashboard/_content_dashboard_items'); ?>

    <div class="row">
        <div class="col-12">
            <h1><?= Yii::t('app', 'SEO_MODULE'); ?></h1>
            <hr>
        </div>
    </div>
    <?= $this->render('//layouts/dashboard/_seo_dashboard_items'); ?>

</div>