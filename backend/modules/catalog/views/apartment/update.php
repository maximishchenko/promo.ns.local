<?php

$this->title = Yii::t('app', 'Update Apartment: {name}', [
    'name' => $model->apartmentName,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Apartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
