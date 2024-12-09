<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Акции';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="shares">
  <div class="container">
    <h1>
      <?= $this->title; ?>
    </h1>
    <div class="shares__wrap">

    <?php if($offers): ?>
      <?php foreach($offers as $offer): ?>
      <div class="news__item">
      <a href="/offer/<?= $offer->slug; ?>">
          <?= Html::img($offer->previewThumb, ['class' => 'news__item-img', 'alt' => $offer->name]); ?>
          <div class="news__item-title"><?= $offer->name; ?></div>
          <div class="room__btn js-open-feedback">Оставить заявку</div>
        </a>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>
  </div>
</section>