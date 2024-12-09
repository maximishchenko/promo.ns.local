<?php

$this->title = Yii::t('app', 'Update Parking: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parkings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parking-update">

    <?= $this->render('//layouts/content/premise/_form', [
        'model' => $model,
    ]) ?>

</div>
