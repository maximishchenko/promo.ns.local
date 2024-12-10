<?php
use frontend\modules\content\models\DocumentCategory;
use frontend\modules\content\models\Mortgage;
use frontend\modules\content\models\Offer;
use frontend\modules\content\models\Premise;
use yii\helpers\Html;


?>



<div class="container">
    <div class="header__wrap">
        <div class="header__left">
            <!-- <div class="header__burger"></div> -->
            <nav class="header__nav">
                <?= Html::a('Квартиры', "#flats_block", ['class' => 'header__nav-link']); ?>
                <?= Html::a('Контакты', "#contacts_block", ['class' => 'header__nav-link']); ?>
                <?php // if(Premise::getParkingActiveItem($parkingId) || Premise::getParkingStages($parkingId)): ?>
                    <?php // echo Html::a('Паркинг', ['/parking'], ['class' => 'header__nav-link']); ?>
                <?php // endif; ?>
                <?php // if(Premise::getStorageActiveItem($storageId) || Premise::getStorageStages($storageId)): ?>
                    <?php // echo Html::a('Кладовые', ['/storage'], ['class' => 'header__nav-link']); ?>
                <?php // endif; ?>
                <?php // if(Offer::getActiveOffer()): ?>
                    <?php // echo Html::a('Акции', ['/offer'], ['class' => 'header__nav-link']); ?>
                <?php // endif; ?>
            </nav>
        </div>
        <a href="<?= Yii::$app->homeUrl; ?>" class="header__logo">
            <?= Html::img('/static/logo.png', ['class' => 'header__logo__img']); ?>
            <!-- <div class="header__logo__text">Новый Город</div> -->
        </a>
        <div class="header__right">
            <nav class="header__nav">
                <?= Html::a('Другие наши проекты', Yii::$app->configManager->getItemValue('anotherProjectsUrl'), ['class' => 'header__nav-link', 'target' => 'blank']); ?>
                <?php // echo Html::a('Контакты', ['/contact'], ['class' => 'header__nav-link']); ?>
            </nav>
            <div class="header__blocks">
                <?= Html::a(Yii::$app->configManager->getItemValue('contactPhone'), 'tel:' . Yii::$app->configManager->getItemValue('contactPhone'), ['class' => 'header__phone']); ?>
                <?php // echo Html::button('Заказать звонок', ['class' => 'js-open-feedback'])?>
            </div>
        </div>
        <div class="header__menu">
            <?php if(Mortgage::getActiveMortgages()): ?>
                <?= Html::a('Ипотека', ['/payment/mortgage'], ['class' => 'header__menu-link']); ?>
            <?php endif; ?>
            <?= Html::a('Ход строительства', ['/gallery'], ['class' => 'header__menu-link']); ?>
            <?php if (Premise::getCommercialActiveItem($commercialId) || Premise::getCommercialStages($commercialId)): ?>
                <?= Html::a('Коммерческие помещения', ['/commercial'], ['class' => 'header__menu-link']); ?>
            <?php endif; ?>
            <?php if(DocumentCategory::getActiveCategories()): ?>
                <?= Html::a('Документы', ['/documents'], ['class' => 'header__menu-link']); ?>
            <?php endif; ?>
            <?= Html::a('Способы оплаты', ['/payment'], ['class' => 'header__menu-link']); ?>
        </div>
        <div class="mobile-menu">
            <?= Html::a('Выбрать квартиру', ['/filter'], ['class' => 'mobile-menu__link']); ?>
            <?php if(Mortgage::getActiveMortgages()): ?>
                <?= Html::a('Ипотека', ['/payment/mortgage'], ['class' => 'mobile-menu__link']); ?>
            <?php endif; ?>
            <?php if(Offer::getActiveOffer()): ?>
                <?= Html::a('Акции', ['/offer'], ['class' => 'mobile-menu__link']); ?>
            <?php endif; ?>
            <?= Html::a('Ход строительства', ['/gallery'], ['class' => 'mobile-menu__link']); ?>
            <?php if(Premise::getParkingActiveItem($parkingId) || Premise::getParkingStages($parkingId)): ?>
                <?= Html::a('Паркинг', ['/parking'], ['class' => 'mobile-menu__link']); ?>
            <?php endif; ?>
            <?php if(Premise::getStorageActiveItem($storageId) || Premise::getStorageStages($storageId)): ?>
                <?= Html::a('Кладовые помещения', ['/storage'], ['class' => 'mobile-menu__link']); ?>
            <?php endif; ?>
            <?php if (Premise::getCommercialActiveItem($commercialId) || Premise::getCommercialStages($commercialId)): ?>
                <?= Html::a('Коммерческие помещения', ['/commercial'], ['class' => 'mobile-menu__link']); ?>
            <?php endif; ?>
            <?php if(DocumentCategory::getActiveCategories()): ?>
                <?= Html::a('Документы', ['/documents'], ['class' => 'mobile-menu__link']); ?>
            <?php endif; ?>
            <?= Html::a('Способы оплаты', ['/payment'], ['class' => 'mobile-menu__link']); ?>
            <?= Html::a('Другие наши проекты', Yii::$app->configManager->getItemValue('anotherProjectsUrl'), ['class' => 'mobile-menu__link', 'target' => 'blank']); ?>
            <?= Html::a('Контакты', ['/contact'], ['class' => 'mobile-menu__link']); ?>
        </div>
    </div>
</div>