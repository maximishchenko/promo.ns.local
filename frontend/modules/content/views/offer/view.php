<?php

use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Акции', 'url' => ['/offer']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    article * {
        margin: 1rem 0;
    }   
    article .room__btn  {
        margin-bottom: 2rem;
    }
    article p {
        font-size: 1.125rem;
        line-height: 1.5625rem;
        margin-bottom: 0;
        letter-spacing: -.01em;
        color: #000;
    }    
</style>

<div class="container">

    <article>

    <h1>
        <?= $model->name; ?>
    </h1>

    <?= Html::img($model->previewThumb, []); ?>
    
    <?php if($model->preview_text): ?>
    <p>
        <?= $model->preview_text; ?>
    </p>
    <?php endif; ?>
    <div class="room__btn js-open-feedback">Оставить заявку</div>
    </article>
</div>