<?php

use frontend\modules\content\models\Bank;
use yii\helpers\Html;

?>
<div class="banks">
  <div class="page-title">Аккредитованные банки</div>
  <div class="bank-list">
    <?php foreach($banks as $bank): ?>
      <div class="bank-list__item">
        <?= Html::img($bank->imagePath, ['alt' => $bank->name]); ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>