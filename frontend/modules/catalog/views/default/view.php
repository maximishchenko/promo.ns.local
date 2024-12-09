<?php

use common\models\ApartmentStatus;
use frontend\modules\catalog\models\Apartment;
use yii\helpers\Html;

$count = ($model->extended_count_rooms) ? $model->extended_count_rooms : $model->layout->count_rooms;
$area = ($model->extended_total_area) ? $model->extended_total_area : $model->layout->total_area;
$this->title = $count . '-комнатная квартира ' . $area . '&nbsp;м<sup>2</sup>';
$this->params['breadcrumbs'][] = ['label' => 'Выбрать квартиру', 'url' => ['/filter']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="room">
  <div class="container">
    <h1 class="room__header"><?= $this->title; ?> </h1>
    <div class="room__wrap">
      <div class="room__left">
        <div class="room__top">

          <div class="room__top-item room__top-item--active" data-id="1">
            <a class="room__image" href="<?= ($model->extendedLayoutThumb) ? $model->extendedLayoutThumb : $model->layout->thumb; ?>" data-fancybox="room"> <!-- $model->thumb -->
              <img src="<?= ($model->extendedLayoutThumb) ? $model->extendedLayoutThumb : $model->layout->thumb; ?>">
              <div class="room__image-zoom">
                <?= Html::img('/static/sprite.svg#zoom-icon'); ?>
              </div>
            </a>
          </div>

          <?php if ($model->thumb): ?>
          <div class="room__top-item" data-id="2">
            <a class="room__image" href="<?= $model->thumb; ?>" data-fancybox="entrance"> <!-- $model->layout->thumb -->
              <img src="<?= $model->thumb; ?>">
              <!-- <svg width="662" height="747" viewBox="0 0 662 747" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="is-active" opacity="0.8" d="M257.623 547.64V416.182L305.538 415.772V404.305H334.205V407.581L413.244 408.4L412.425 555.012H341.986V547.64H257.623Z" fill="white"></path>
              </svg> -->
              <div class="room__image-zoom">
                <?= Html::img('/static/sprite.svg#zoom-icon'); ?>
              </div>
            </a>
          </div>
          <?php endif; ?>

        </div>
        <?php if ($model->extended_layout_image || $model->layout->image): ?>
        <div class="room__tabs">
          <div class="room__tab room__tab--active page-btn" data-id="1">Квартира</div>
          <div class="room__tab page-btn" data-id="2">Расположение</div>
        </div>
        <?php endif; ?>
      </div>
      <div class="room__info">
        <div class="room__info-items">
          <div class="room__info-item">
            <div class="room__info-item-title">Литер</div>
            <div class="room__info-item-text">
              <?= $model->layout->entrance->house->name; ?>
            </div>
          </div>
          <div class="room__info-item">
            <div class="room__info-item-title">Подъезд</div>
            <div class="room__info-item-text">
              <?= $model->entrance->number; ?>
            </div>
          </div>
          <div class="room__info-item">
            <div class="room__info-item-title">Комнат</div>
            <div class="room__info-item-text">
              <?= ($model->extended_count_rooms) ? $model->extended_count_rooms : $model->layout->count_rooms; ?>
            </div>
          </div>
          <div class="room__info-item">
            <div class="room__info-item-title">Площадь</div>
            <div class="room__info-item-text">
              <?= ($model->extended_total_area) ? $model->extended_total_area : $model->layout->total_area; ?> м<sup>2</sup>
            </div>
          </div>
        </div>


<!--        <div class="room__btn js-open-feedback">Оставить заявку</div>-->
          <?php if(Yii::$app->configManager->getItemValue('contactPhone')): ?>
              <a class="header__phone" href="tel:<?= Yii::$app->configManager->getItemValue('contactPhone'); ?>">
                  <section class="contacts__info-text">
                          Отдел продаж: <?= Yii::$app->configManager->getItemValue('contactPhone'); ?>
                  </section>
              </a>
            <?php endif; ?>


        <div class="room__info-items mar_2_4_top">
          <?php if($model->sale_status == ApartmentStatus::STATUS_FREE && $model->getCostPerSquareMater()): ?>
            <div class="room__info-item">
              <div class="room__info-item-title">
                Стоимость 1 м<sup>2</sup>
              </div>
              <div class="room__info-item-text">
                <?= Yii::$app->formatter->asCurrency($model->getCostPerSquareMater()); ?>
              </div>
            </div>
            <div class="room__info-item">
              <div class="room__info-item-title">
                Стоимость квартиры
              </div>
              <div class="room__info-item-text">
                <?= Yii::$app->formatter->asCurrency($model->getTotalPrice()); ?>

                <?php if($model->getDiscount() > 0): ?>
                  <span class="old__price">
                    <?= Yii::$app->formatter->asCurrency($model->getOldPrice()) ; ?>
                  </span>
                <?php endif;?>
              </div>
            </div>
          <?php endif;?>
        </div>

      </div>




    </div>
  </div>
</section>



<?= $this->render('//layouts/template/product/_layout_scheme', ['entrance' => $model->entrance, 'apartmentModel' => new Apartment(), 'current' => $model->id]); ?>