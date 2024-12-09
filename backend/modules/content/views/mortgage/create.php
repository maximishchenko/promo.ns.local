<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Add new Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mortgages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mortgage-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
