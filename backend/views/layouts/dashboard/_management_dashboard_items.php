<?php

use yii\helpers\Url;
use \hail812\adminlte\widgets\SmallBox;
?>
<div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'SETTINGS'),
                'text' => Yii::t('app', 'SETTINGS Edit'),
                'icon' => 'fas fa-cog',
                'theme' => 'danger',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/management/settings'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= SmallBox::widget([
                'title' => Yii::t('app', 'USERS'),
                'text' => Yii::t('app', 'USERS Edit'),
                'icon' => 'fas fa-users',
                'theme' => 'danger',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/management/users'])
            ]) ?>
        </div>
</div>