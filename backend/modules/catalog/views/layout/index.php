<?php

use backend\modules\catalog\models\Entrance;
use backend\modules\catalog\models\House;
use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Layouts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layout-index">

    <p class="text-right">
        <?= ListButtonsWidget::widget() ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            ],
            [
                'attribute' => 'house',
                'format' => 'raw',
                'filter' => ArrayHelper::map(House::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'nameWithPrefix'),
                'value' => function($data) {
                    return $data->house->nameWithPrefix;
                }
            ],
            [
                'attribute' => 'entrance',
                'format' => 'raw',
                'filter' => ArrayHelper::map(Entrance::find()->orderBy(['number' => SORT_ASC])->all(), 'id', 'numberWithPrefix'),
                'value' => function($data) {
                    return $data->entrance->numberWithPrefix;
                }
            ],
            'count_rooms',
            'total_area',
            [
                'attribute' => 'sort',
                'contentOptions' => ['style' => 'width:100px;'],
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
