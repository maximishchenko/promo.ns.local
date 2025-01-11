<?php

use yii\helpers\Html;

// $this->title = 'Контакты';
// $this->params['breadcrumbs'][] = $this->title;
// /static/logo.png
?>

<script src="https://api-maps.yandex.ru/2.1/?apikey=<?= Yii::$app->configManager->getItemValue('mapApiKey'); ?>&lang=ru_RU" type="text/javascript"></script>

<script type="text/javascript">
    ymaps.ready(init);
    function init(){
        var locations = <?= json_encode(Yii::$app->configManager->getItemValue('location')); ?>.split(",");
        var map_root = document.getElementById("map");
        
        var map_title = map_root.getAttribute("data-map-title");
        var map_body = map_root.getAttribute("data-map-body");
        var map_footer = map_root.getAttribute("data-map-footer");
        var officeMap = new ymaps.Map("map", {
            center: locations,
            zoom: 13,
            controls: [],
        });
        
        var officePlaceMark = new ymaps.Placemark(locations, {
                balloonContentHeader: map_title,
                balloonContentBody: map_body,
                balloonContentFooter: map_footer,
                hintContent: map_title
            }, 
            {
                overlayFactory: 'default#interactiveGraphics',
                iconLayout: 'default#image',
                // iconImageHref: '/static/sprite.svg#logo',
                iconImageHref: '/static/logo.png',
                iconImageSize: [60, 60],
                iconImageOffset: [-30, -70],
                iconCaption: map_title
            }
        );			 	
            
        officeMap.geoObjects.add( officePlaceMark );
        officeMap.behaviors.disable('scrollZoom');
        officeMap.behaviors.disable('drag');
    }		
</script>


<section class="contacts" id="contacts_block">
  <div class="container">
    <h1>
      Контакты
      <?php // echo Html::encode($this->title); ?>
    </h1>
    <div class="contacts__wrap">
      <div class="contacts__info">
        <div class="contacts__item">
          <div class="contacts__item-title">Адрес</div>
          <div class="contacts__item-text">
            <?= Yii::$app->configManager->getItemValue('contactAddress'); ?>
          </div>
        </div>
        <div class="contacts__item">
          <div class="contacts__item-title">Телефон</div>
          <?= Html::a(Yii::$app->configManager->getItemValue('contactPhone'), 'tel:' . Yii::$app->configManager->getItemValue('contactPhone'), ['class' => 'contacts__item-text']); ?>
        </div>
        <div class="contacts__item">
          <div class="contacts__item-title">E-mail</div>
          <?= Html::mailto(Yii::$app->configManager->getItemValue('contactEmail'), Yii::$app->configManager->getItemValue('contactEmail'), ['class' => 'contacts__item-text']); ?>
        </div>
      </div>

      <div id="map" class="map" data-map-title="Новый город" data-map-body="<?= Yii::$app->configManager->getItemValue('contactPhone'); ?>" data-map-footer="<?= Yii::$app->configManager->getItemValue('contactEmail'); ?>">
        
      </div>

    </div>
  </div>
</section>
 
  
