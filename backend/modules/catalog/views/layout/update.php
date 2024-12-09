<?php

use backend\widgets\LinkColumn;
use backend\widgets\SetColumn;
use common\models\ApartmentStatus;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Update Layout: {name}', [
    'name' => $model->nameWithCountRoomsAndTotalArea,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Layouts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layout-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?php if($apartments->getCount()): ?>
    <div class="row__section">
    <h2>
        <?= Yii::t('app', 'Current Layout Apartments'); ?>
    </h2>
    <?= GridView::widget([
        'dataProvider' => $apartments,
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
                'attribute' => 'apartmentName',
                'contentOptions' => ['class' => 'text-wrap'],
                'headerOptions' => [
                    'class' => 'sort-numerical',
                ],
                'value' => function($data) {
                    return Html::a($data->apartmentName, ['/catalog/apartment/update', 'id' => $data->id], []);
                }
            ],
            [
                'class' => SetColumn::className(),
                'filter' => ApartmentStatus::getStatusesArray(),
                'attribute' => 'sale_status',
                'name' => function($data) {
                    return ArrayHelper::getValue(ApartmentStatus::getStatusesArray(), $data->sale_status);
                },
                'contentOptions' => ['style' => 'width:100px;'],
                'cssCLasses' => [
                    ApartmentStatus::STATUS_FREE => 'danger',
                    ApartmentStatus::STATUS_RESERVED => 'info',
                    ApartmentStatus::STATUS_SOLD => 'success',
                ],
            ],
        ],
    ]); ?>

    </div>
    <?php endif; ?>
</div>
