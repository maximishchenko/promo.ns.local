<?php

$this->title = 'Ход строительства: ' . $house->nameWithPrefix;

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/gallery']];
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="construction" id="pdopage">
  <div class="container">

    <h1>
        <?= $this->title; ?>
    </h1>

    <div class="construction__wrap rows">
        <?php foreach ($house->galleries as $gallery): ?>
            <?= $this->render('//layouts/template/gallery/_item', ['model' => $gallery]); ?>
        <?php endforeach; ?>
    </div>
  </div>
</section>