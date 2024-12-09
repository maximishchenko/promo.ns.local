<?php

use backend\widgets\LinkColumn;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Update House: {name}', [
    'name' => $model->nameWithPrefix,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php if($entrances->getCount()): ?>
    <div class="row__section">
    <h2>
        <?= Yii::t('app', 'Current House Entrances'); ?>
    </h2>
    <?= GridView::widget([
        'dataProvider' => $entrances,
        'filterModel' => false,
        'layout' => "{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'number',
                'contentOptions' => ['class' => 'text-wrap'],
                'headerOptions' => [
                    'class' => 'sort-numerical',
                ],
                'value' => function($data) {
                    return Html::a($data->numberWithPrefix, ['/catalog/entrance/update', 'id' => $data->id], []);
                }
            ],
            [
                'class' => SetColumn::className(),
                'filter' => Status::getStatusesArray(),
                'attribute' => 'status',
                'name' => function($data) {
                    return ArrayHelper::getValue(Status::getStatusesArray(), $data->status);
                },
                'contentOptions' => ['style' => 'width:100px;'],
                'cssCLasses' => [
                    Status::STATUS_ACTIVE => 'success',
                    Status::STATUS_BLOCKED => 'danger',
                ],
            ],
        ],
    ]); ?>

    </div>
    <?php endif; ?>
</div>
