<?php

$this->title = Yii::t('app', 'Add new Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parkings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parking-create">

    <?= $this->render('//layouts/content/premise/_form', [
        'model' => $model,
    ]) ?>

</div>
