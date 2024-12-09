<?php

use yii\helpers\Html;

$this->title = 'Способы оплаты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
  <h1>
    <?= $this->title; ?>
  </h1>
  <section class="payment-links">
    <div class="container">
      <div class="payment-links__wrap">
        <?php if($payments): ?>
          <?php foreach($payments as $payment): ?>
            <div class="payment-links__item">
              <div class="payment-links__item-image">
                <?= Html::img($payment->imagePath, ['alt' => $payment->name])?>
              </div>
              <div class="payment-links__item-text">
                <?= $payment->name; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php foreach ($payments as $k => $payment): ?>
  <section class="<?= ($k % 2) ? 'payment-info payment-info--reverse' : 'payment-info'; ?> "> 
    <div class="payment-info__wrap"> 
      <div class="payment-info__left"> 
        <div class="payment-info__title">
        <?= $payment->name; ?>
        </div>
        <div class="payment-info__text">
        <?= $payment->text; ?>
        </div>
        <!-- <a class="payment-info__link" href="/sposobyi-oplatyi/ipoteka/">Подробнее</a> -->
      </div>
      <div class="payment-info__image">
        <?= Html::img($payment->imagePath, ['alt' => $payment->name])?>
      </div>
    </div>
  </section>
  <?php if($k == 0): ?>
  <section class="mortgage">

    <?php if($banks): ?>
      <?= $this->render('_banks', ['banks' => $banks]); ?>
    <?php endif; ?>
    
  </section>
  <?php endif; ?>
  <?php endforeach; ?>
</div>
  
<?= $this->render('//layouts/template/form/_inline', ['title' => '']); ?>