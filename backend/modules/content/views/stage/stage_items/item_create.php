<?php

$this->title = Yii::t('app', 'Add new Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stage Items: {name}', ['name' => $model->name]), 'url' => ['items', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-elements-create">

    <?= $this->render('_item_form', [
        'model' => $model,
        'itemModel' => $itemModel,
    ]) ?>

</div>
