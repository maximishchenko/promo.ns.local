<?php

$this->title = Yii::t('app', 'Document Name: {name}', ['name' => $documentModel->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $documentModel->category->name, 'url' => ['update', 'id' => $documentModel->category->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents Category: {name}', ['name' => $documentModel->category->name]), 'url' => ['documents', 'id' => $documentModel->category_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-elements-update">

    <?= $this->render('_form', [
        'model' => $model,
        'documentModel' => $documentModel,
    ]) ?>

</div>
