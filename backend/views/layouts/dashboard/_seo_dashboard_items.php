<?php

use yii\helpers\Url;
use \hail812\adminlte\widgets\SmallBox;
?>
<div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'ROBOTS.TXT'),
                'text' => Yii::t('app', 'ROBOTS Edit'),
                'icon' => 'fas fa-cog',
                'theme' => 'info',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/seo/robots'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'REDIRECT BLOCK'),
                'text' => Yii::t('app', 'REDIRECT MANAGEMENT'),
                'icon' => 'fas fa-cog',
                'theme' => 'info',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/seo/redirect'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'Script BLOCK'),
                'text' => Yii::t('app', 'Script MANAGEMENT'),
                'icon' => 'fas fa-cog',
                'theme' => 'info',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/seo/script'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'MetaTag BLOCK'),
                'text' => Yii::t('app', 'MetaTag MANAGEMENT'),
                'icon' => 'fas fa-cog',
                'theme' => 'info',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/seo/meta-tag'])
            ]) ?>
        </div>
</div>