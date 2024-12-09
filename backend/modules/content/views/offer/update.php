<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Update Offer: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Offers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="offer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
