<?php

use hail812\adminlte\widgets\SmallBox;
use yii\helpers\Url;

?>

<div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'Lead'),
                'text' => Yii::t('app', 'Lead Edit'),
                'icon' => 'fas fa-inbox',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/lead'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'Stage'),
                'text' => Yii::t('app', 'Stage Edit'),
                'icon' => 'fas fa-camera',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/stage'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'Projects'),
                'text' => Yii::t('app', 'Projects Edit'),
                'icon' => 'fa fa-file',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/projects'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php SmallBox::widget([
                'title' => Yii::t('app', 'Offer'),
                'text' => Yii::t('app', 'Offer Edit'),
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/offer'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php SmallBox::widget([
                'title' => Yii::t('app', 'Gallery'),
                'text' => Yii::t('app', 'Gallery Edit'),
                'icon' => 'fa fa-file-image',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/gallery'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php SmallBox::widget([
                'title' => Yii::t('app', 'Parking'),
                'text' => Yii::t('app', 'Parking Edit'),
                'icon' => 'fa fa-car',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/parking'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php SmallBox::widget([
                'title' => Yii::t('app', 'Storage'),
                'text' => Yii::t('app', 'Storage Edit'),
                'icon' => 'fa fa-shopping-basket',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/storage'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php SmallBox::widget([
                'title' => Yii::t('app', 'Commercial'),
                'text' => Yii::t('app', 'Commercial Edit'),
                'icon' => 'fa fa-building',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/commercial'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php SmallBox::widget([
                'title' => Yii::t('app', 'Document'),
                'text' => Yii::t('app', 'Document Edit'),
                'icon' => 'fa fa-file',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/document'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php SmallBox::widget([
                'title' => Yii::t('app', 'Bank'),
                'text' => Yii::t('app', 'Bank Edit'),
                'icon' => 'fa fa-file',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/bank'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php SmallBox::widget([
                'title' => Yii::t('app', 'Mortgage'),
                'text' => Yii::t('app', 'Mortgage Edit'),
                'icon' => 'fa fa-file',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/mortgage'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php SmallBox::widget([
                'title' => Yii::t('app', 'Payments'),
                'text' => Yii::t('app', 'Payments Edit'),
                'icon' => 'fa fa-file',
                'theme' => 'warning',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/content/payment'])
            ]) ?>
        </div>
</div>