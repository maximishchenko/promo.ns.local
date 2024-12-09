<?php

use yii\helpers\Html;

$this->title = 'Ход строительства';
$this->params['breadcrumbs'][] = $this->title;
?>`

<section class="construction" id="pdopage">
  <div class="container">
    <h1>
      <?= $this->title; ?>
    </h1>

    <div class="construction__wrap rows">
    <?php foreach ($houses as $k => $house): ?>
      <a href="/gallery/<?= $house->id; ?>">
        <img src="<?= $house->thumb; ?>" />
        <h2 class="h2title">
          <?= $house->nameWithPrefix; ?>
        </h2>
      </a>
    <?php endforeach; ?>
    </div>
  </div>
</section>
