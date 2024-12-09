<?php
use frontend\modules\content\models\DocumentCategory;
use frontend\modules\content\models\Mortgage;
use frontend\modules\content\models\Offer;
use frontend\modules\content\models\Premise;
use yii\helpers\Html;
?>

<footer class="footer">
  <div class="container">
    <div class="footer__top">
      <div class="footer__title">Контакты</div>
      <div class="footer__wrap">
        <div class="footer__contacts">
          <div class="footer__contacts-item">
            <div class="footer__contacts-title">Адрес</div>
            <div class="footer__contacts-text">
              <?= Yii::$app->configManager->getItemValue('contactAddress'); ?>
            </div>
          </div>
          <div class="footer__contacts-item">
            <div class="footer__contacts-title">Телефон</div>
            <?= Html::a(Yii::$app->configManager->getItemValue('contactPhone'), 'tel:' . Yii::$app->configManager->getItemValue('contactPhone'), ['class' => 'footer__contacts-text']); ?>
          </div>
          <div class="footer__contacts-item">
            <div class="footer__contacts-title">E-mail</div>
            <?= Html::mailto(Yii::$app->configManager->getItemValue('contactEmail'), Yii::$app->configManager->getItemValue('contactEmail'), ['class' => 'footer__contacts-text']); ?>
          </div>
        </div>
        <div class="footer__menu">
          <div class="footer__links">
            <div class="footer__links-col">
              <div class="footer__links-title">ООО "Новострой"</div>
              <div class="footer__links-items">
                <?= Html::a('Квартиры', "#flats_block", ['class' => 'footer__links-item']); ?>
                <?= Html::a('Контакты', "#contacts_block", ['class' => 'footer__links-item']); ?>
              </div>
            </div>
            <div class="footer__links-col">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__copyright">&copy; <?= date('Y'); ?> ООО "Новострой"</div>
            <?= Html::a('Политика конфиденциальности', ['/policy'], ['class' => 'footer__bottom-link']); ?>
        </div>
    </div>
</footer>