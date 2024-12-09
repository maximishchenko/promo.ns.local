<?php

use frontend\modules\catalog\models\Apartment;

$this->title = 'Выбрать квартиру';
$this->params['breadcrumbs'][] = $this->title;

//$query = Apartment::find()->joinWith(['house'])->distinct('layout_id')->forSale()->active();
//var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);

?>

<section class="room-search">
  <div class="container">
    <h1>
      <?= $this->title; ?>
    </h1>
          
    <?= $this->render('//layouts/template/product/_search', ['searchModel' => $searchModel]); ?>

    <div class="room-search__items rows">
      <?= $this->render('//layouts/template/product/_list', ['dataProvider' => $dataProvider]); ?>
    </div>

    <?= $this->render('//layouts/template/product/_pager', ['dataProvider' => $dataProvider]); ?>

  </div>
</section>
      