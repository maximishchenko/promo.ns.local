<?php

use yii\helpers\Url;
use \hail812\adminlte\widgets\SmallBox;
?>
<div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'HOUSE'),
                'text' => Yii::t('app', 'HOUSE Edit'),
                'icon' => 'fas fa-cog',
                'theme' => 'success',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/catalog/house'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'Entrance'),
                'text' => Yii::t('app', 'Entrance Edit'),
                'icon' => 'fas fa-users',
                'theme' => 'success',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/catalog/entrance'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'Layout'),
                'text' => Yii::t('app', 'Layout Edit'),
                'icon' => 'fas fa-users',
                'theme' => 'success',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/catalog/layout'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'Apartment'),
                'text' => Yii::t('app', 'Apartment Edit'),
                'icon' => 'fas fa-users',
                'theme' => 'success',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/catalog/apartment'])
            ]) ?>
        </div>
</div>