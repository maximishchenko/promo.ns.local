<?php

$this->title = Yii::t('app', 'Stage Item Name: {name}', ['name' => $itemModel->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $itemModel->stage->name, 'url' => ['update', 'id' => $itemModel->stage->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stage Item: {name}', ['name' => $itemModel->stage->name]), 'url' => ['items', 'id' => $itemModel->stage_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-elements-update">

    <?= $this->render('_item_form', [
//        'model' => $model,
        'model' => $itemModel->stage,
        'itemModel' => $itemModel,
    ]) ?>

</div>
