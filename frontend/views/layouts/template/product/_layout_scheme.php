<?php

use common\models\ApartmentStatus;

/** @var \frontend\modules\catalog\models\Apartment $apartmentModel **/
/** @var \frontend\modules\catalog\models\Entrance $entrance **/
/** @var $current **/

if (isset($house) && !empty($house))
{
  $layout_title = "Литер № " . $house . ", " . $entrance->numberWithPrefix;
} else {
  $layout_title = $entrance->numberWithPrefix;
}
?>

<div class="apartments-list-wraper">
  <h2 style="text-align: center; margin-bottom: 1rem;">
    <?= $layout_title; ?>
  </h2>

    <div class="apartments-list-legend">
        <div class="apartments-list-legend__item">
            <span class="apartments-list-legend__item__color apartments-list-legend__item__color--free"></span> - свободна
        </div>
        <div class="apartments-list-legend__item">
            <span class="apartments-list-legend__item__color apartments-list-legend__item__color--sold"></span> - продана
        </div>
        <div class="apartments-list-legend__item">
            <span class="apartments-list-legend__item__color apartments-list-legend__item__color--reserved"></span> - бронь
        </div>
        <?php if($current != null): ?>
            <div class="apartments-list-legend__item">
                <span class="apartments-list-legend__item__color apartments-list-legend__item__color--selected"></span> - выбрано вами
            </div>
        <?php endif; ?>
    </div>

  <section class="apartments-list" style="grid-template-columns: 60px repeat(<?= count($entrance->layouts) ; ?>, 1fr); ">
      <?php if($entrance->has_commercial_floor): ?>

      <div class="apartments-list__label">
          <div class="apartments-list__label__text">
              1 этаж
          </div>
      </div>

      <div class="apartments-list__item apartments-list__item--commercial" style="grid-column-start: 2; grid-column-end: <?= count($entrance->layouts) + 2 ; ?>">
          <div class="apartments-list__item__title">
              Коммерческий этаж
          </div>
      </div>

      <?php endif; ?>

<?php for($floor = $entrance->getFirstFloorNumber(); $floor <= $entrance->count_floors; $floor++): ?>
      <div class="apartments-list__label">
        <div class="apartments-list__label__text">
          <?= $floor; ?> этаж
        </div>
      </div>

      <?php foreach($entrance->layouts as $layout): ?>

        <?php  $apartment = $apartmentModel->getApartmentsByFloorAndLayout($floor, $layout->id); ?>

        <?php if ($apartment && $apartment->number): ?>
                <div class="apartments-list__item <?= ($apartment->id == $current) ? ApartmentStatus::SELECTED_ITEM_CSS_CLASS : ApartmentStatus::getStatusesCssClassNames()[$apartment->sale_status]; ?>">
                    <?php if($apartment->id != $current): ?>
                        <!-- <a href="/filter/<?php // echo $apartment->slug; ?>"> -->
                    <?php endif; ?>
                          <div class="apartments-list__item__title">
                            <span class="apartment-name">Квартира </span><?= $apartment->number; ?>
                          </div>
                          <div class="apartments-list__item__content">
                            <div class="apartment-rooms">
                              <?= ($apartment->extended_count_rooms) ? $apartment->extended_count_rooms : $layout->count_rooms; ?>-комнатная
                            </div>
                            <div class="apartment-area">
                              <?= ($apartment->extended_total_area) ? $apartment->extended_total_area : $layout->total_area; ?>
                            </div>
                          </div>
                    <?php if($apartment->id != $current): ?>
                        <!-- </a> -->
                    <?php endif; ?>
                </div>
        <?php else: ?>

        <div class="apartments-list__item">
        </div>

        <?php endif; ?>

      <?php endforeach; ?>

    <?php endfor; ?>

  </section>

</div>