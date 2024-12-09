<?php

$this->title = Yii::t('app', 'Update Stage: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stage-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
