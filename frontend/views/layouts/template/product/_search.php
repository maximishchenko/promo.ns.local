<?php

use common\models\ApartmentSort;
use frontend\modules\catalog\models\Apartment;
use frontend\modules\catalog\models\search\ApartmentSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$apartmentSort = new ApartmentSort();

/**
 * @var $searchModel ApartmentSearch
 */
?>

<?php $form = ActiveForm::begin([
  'action' => ['index'],
  'method' => 'get',
  'options' => [
    'class' => 'room-search__filter'
  ],      
  'enableAjaxValidation' => false,
  'enableClientValidation' => false,
  'enableClientScript' => false,
]); ?>

  <div class="room-search__filter-wrap">
    <div class="room-search__select">
      <div class="room-search__select-top">
        <span>
          <?= $searchModel->getHouseNameById(); ?>
        </span>
        <!-- TODO sprite -->
        <?= Html::img('/static/svg/select-arrow.svg'); ?>
        <input type="hidden" name="house" value="" />
      </div>

      <div class="room-search__select-inside">
        <?php foreach($searchModel->getHouses() as $house): ?>
        <div class="room-search__select-inside-link" data-id="<?= $house->id; ?>">
          <?= 'Литер ' . $house->name; ?>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
    <div class="room-search__bedrooms">
      <div class="room-search__filter-title">Комнат</div>
      <div class="room-search__bedrooms-wrap">
        <?php for ($countRooms = $searchModel->getMinRoomsCount(); $countRooms <= $searchModel->getMaxRoomsCount(); $countRooms++): ?>
        <div class="room-search__bedrooms-item">
          <input type="radio" name="countRooms" id="count_rooms_<?= $countRooms; ?>" value="<?= $countRooms; ?>" <?= $searchModel->isCountRoomsChecked($countRooms); ?> />
          <label for="count_rooms_<?= $countRooms; ?>">
            <?= $countRooms; ?>
          </label>
        </div>
        <?php endfor; ?>

      </div>
    </div>
    <div class="room-search__range">
      <div data-min-area="<?= $searchModel->getMinTotalArea(); ?>" data-max-area="<?= $searchModel->getMaxTotalArea(); ?>" class="room-search__title">Площадь</div>
      <div class="room-search__range-wrap">
        <input class="js-range-slider" type="text" name="area" value="" tabindex="-1" readonly="" />
      </div>
      <input id="minArea" name="minArea" class="hidden__input" readonly value="<?= Apartment::getMinArea(); ?>">
      <input id="maxArea" name="maxArea" class="hidden__input" readonly value="<?= Apartment::getMaxArea(); ?>">
    </div>
  </div>
  
  <?= Html::submitButton('Применить фильтр')?>
<?php ActiveForm::end(); ?>

<div class="room-search__top">
  <div class="room-search__sort">
    <div class="room-search__sort-title">Сортировать по площади:</div>
    <div class="room-search__select">
      <div class="room-search__select-top">
        <span>
          <?= $apartmentSort->getCurrentSortText(); ?>
        </span>
        <!-- TODO sprite -->
        <?= Html::img('/static/svg/select-arrow.svg'); ?>
      </div>
      <div class="room-search__select-inside">
        <a href="<?= $apartmentSort->getAvailableSortParam(); ?>" class="room-search__select-inside-link">
          <?= $apartmentSort->getAvailableSortText(); ?>
        </a>
      </div>
    </div>
  </div>
  
  <?= Html::a('Сбросить фильтр', ['/filter'], ['class' => 'room-search__reset']); ?>
</div>