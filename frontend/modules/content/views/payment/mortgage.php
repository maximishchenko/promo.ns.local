<?php

$this->title = 'Ипотека';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="mortgage">
  <div class="container">
    <h1>
      <?= $this->title; ?>
    </h1>

    <?php if($mortgages): ?>
    <div class="mortgage__wrap">

      <?php foreach($mortgages as $mortgage): ?>
      <div class="mortgage__item">
        <div class="mortgage__item-wrap">
          <div class="mortgage__item-title">
            <?= $mortgage->name; ?>
          </div>
          <div class="mortgage__item-text">
            <?= $mortgage->text; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>

    </div>

    <?php if($banks): ?>
      <?= $this->render('_banks', ['banks' => $banks]); ?>
    <?php endif; ?>
  </div>
    

</section>