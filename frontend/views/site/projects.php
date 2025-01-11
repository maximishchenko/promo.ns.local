<?php

use yii\helpers\Html;

$this->title = 'Объекты группы компаний';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .news__item-img {
        min-height: 355px;
        max-width: 100%;
        max-height: 100%;
        width: 100%;
    }
    .room__btn {
        width: 100%;    
        display: flex;
        align-items: center;
    }
</style>

<div class="container" id="projects_block">
  <h1>
    <?= $this->title; ?>
  </h1>
    <div class="shares__wrap">

    <?php if($projects): ?>
      <?php foreach($projects as $project): ?>
      <div class="news__item">
      <a href="<?= $project->url; ?>" target="_blank">
          <?= Html::img($project->previewThumb, ['class' => 'news__item-img', 'alt' => $project->name]); ?>
          <div class="news__item-title"><?= $project->name; ?></div>
          <div class="room__btn">Перейти</div>
        </a>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>
  </div>
</div>