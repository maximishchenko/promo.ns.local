<?php

use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use frontend\modules\seo\models\MetaTag;
use frontend\modules\seo\models\Script;
use yii\helpers\Url;

AppAsset::register($this);

$commercialId = Yii::$app->configManager->getItemValue('contentCommercialStage');
$storageId = Yii::$app->configManager->getItemValue('contentStorageStage');
$parkingId = Yii::$app->configManager->getItemValue('contentParkingStage');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?= Html::csrfMetaTags() ?>
    <?php $this->registerCsrfMetaTags() ?>

    <?php
    $metaTag = new MetaTag();
    $h1title = $metaTag->setH1Title();
    if (isset($this->blocks['metaTags'])) { 
        echo $this->blocks['metaTags'];
    } else {
        $metaTag->setMetaTags();
    }
    ?>
    <title>
        <?= Html::encode($this->title) ?>
    </title>

    <?php $this->head() ?>

    <?php Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]); ?>

    <!-- Скрипты перед </head> -->
    <?php Script::getScripts(Script::BEFORE_END_HEAD); ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Скрипты после <body> -->
<?php Script::getScripts(Script::AFTER_BEGIN_BODY); ?>

<header class="header">
    <?= $this->render('//layouts/template/_header', ['commercialId' => $commercialId, 'storageId' => $storageId, 'parkingId' => $parkingId]); ?>
</header>

<main class="main">
    <!-- "Хлебные крошки" -->
    <?= $this->render('//layouts/template/_breadcrumbs'); ?>

    <?php // echo $h1title; ?>

    <?php if(!empty($metaTag->setDescriptionSnippet())): ?>
        <p class="description__block">
            <?= $metaTag->setDescriptionSnippet(); ?>
        </p>
    <?php endif; ?>

    <?= $content ?>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <?= $this->render('//layouts/template/_footer', ['commercialId' => $commercialId, 'storageId' => $storageId, 'parkingId' => $parkingId]); ?>
</footer>
<?= $this->render('//layouts/template/form/_modal'); ?>

<!-- Скрипты перед </body> -->
<?php Script::getScripts(Script::BEFORE_END_BODY); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
