<?php

$this->title = Yii::t('app', 'Update Mortgage: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mortgages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mortgage-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
