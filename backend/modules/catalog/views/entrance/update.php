<?php

use backend\widgets\LinkColumn;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Update Entrance: {number}', [
    'number' => $model->getNumberWithPrefix(),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entrances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrance-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    

    <?php if($layouts->getCount()): ?>
    <div class="row__section">
    <h2>
        <?= Yii::t('app', 'Current Entrance Layouts'); ?>
    </h2>
    <?= GridView::widget([
        'dataProvider' => $layouts,
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
                'attribute' => 'nameWithCountRoomsAndTotalArea',
                'contentOptions' => ['class' => 'text-wrap'],
                'headerOptions' => [
                    'class' => 'sort-numerical',
                ],
                'value' => function($data) {
                    return Html::a($data->nameWithCountRoomsAndTotalArea, ['/catalog/layout/update', 'id' => $data->id], []);
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
