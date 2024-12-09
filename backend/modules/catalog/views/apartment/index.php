<?php

use backend\modules\catalog\models\Entrance;
use backend\modules\catalog\models\House;
use backend\modules\catalog\models\Layout;
use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\ApartmentStatus;
use common\models\Status;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Apartments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-index">

    <p class="text-right">
        <?= ListButtonsWidget::widget() ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager'
        ],
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
            ],
            [
                'attribute' => 'house',
                'format' => 'raw',
                'filter' => ArrayHelper::map(House::find()->all(), 'id', 'nameWithPrefix'),
                'value' => function ($data) {
                    return $data->entrance->house->nameWithPrefix ;
                }
            ],
            [
                'attribute' => 'entrance',
                'format' => 'raw',
                'filter' => ArrayHelper::map(Entrance::find()->all(), 'id', 'numberWithPrefix'),
                'value' => function ($data) {
                    return $data->entrance->numberWithPrefix ;
                }
            ],
            [
                'attribute' => 'layout_id',
                'format' => 'raw',
                'filter' => ArrayHelper::map(Layout::find()->all(), 'id', 'nameWithHouseAndSection'),
                'value' => function ($data) {
                    return $data->layout->nameWithHouseAndSection;
                }
            ],
            'apartment_floor',
            [
                'label' => Yii::t('app', "Extended Apartment Params"),
                'format' => 'raw',
                'filter' => false,
                'value' => function($data) {
                    $str = "";
                    if ($data->extended_count_rooms) {
                        $str .= (string)$data->extended_count_rooms . "-комн.";
                    }
                    if ($data->extended_total_area) {
                        $str .=  ", " . (string)$data->extended_total_area . "м2";
                    }
                    return $str;
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
            [
                'class' => ActionColumn::className(),
                'contentOptions' => ['style' => 'width:80px;'],
                'template' => '{delete}',
            ],
        ],
    ]); ?>


</div>
