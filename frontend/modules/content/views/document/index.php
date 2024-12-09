<?php

use common\models\Files;

$this->title = 'Документы';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="docs">
<div class="container">
    <h1>
        <?= $this->title; ?>
    </h1>
    <?php if(isset($categories) && !empty($categories)): ?>
        <?php foreach($categories as $category): ?>
            <div class="docs__content">

                <div class="docs__subtitle">
                    <?= $category->name; ?>
                </div>
                <div class="docs__wrap">
                    <?php if(isset($category->documents) && !empty($category->documents)): ?>
                        <?php foreach($category->documents as $document): ?>
                            <a class="docs__item" href="<?= $document->filePath; ?>" target="_blank">
                                <div class="docs__item-date">
                                    <?= Yii::$app->formatter->asDatetime($category->updated_at, 'dd.MM.YYYY'); ?>
                                </div>
                                <div class="docs__item-title">
                                    <?= $document->name; ?>
                                </div>
                                <div class="docs__item-format">
                                    <?= Files::convertBytes($document->file_size); ?> / <?= strtoupper($document->file_extension); ?>
                                </div>            
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


</div>
</section>