<?php

use backend\modules\content\models\Premise;

$this->title = Yii::t('app', 'Stage Item Name: {name}', ['name' => $advantageModel->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Premise::getTitleByPremiseType()[$model->premise_type], 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Premise Advantage Items: {name}', ['name' => $model->name]), 'url' => ['advantages', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-elements-update">

    <?= $this->render('_advantage_form', [
        // 'model' => $model,
        'advantageModel' => $advantageModel,
    ]) ?>

</div>