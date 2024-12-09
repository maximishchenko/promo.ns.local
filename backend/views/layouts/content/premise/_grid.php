<?php

use backend\widgets\LinkColumn;
use backend\widgets\ListButtonsWidget;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
    
<p class="text-right">
    <?= ListButtonsWidget::widget() ?>
</p>

<div class="alert alert-info">
    Внимание. Для установки основного элемента, содержащего данные заголовка, планировки и преимуществ необходимо задать (<i class="fa fa-check"></i>) один из нижеперечисленных элементов 
    в качестве используемого по-умолчанию. Для отображения изображения заголовка, изображения планировки и набора преимуществ - указанная информация должна присутствовать в отмеченной записи
</div>

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
            'attribute' => 'name',
            'contentOptions' => ['class' => 'text-wrap'],
            'headerOptions' => array(
                'class' => 'sort-numerical',
            ),
        ],
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
            'class' => SetColumn::className(),
            'filter' => false,
            'value' => function($data) {
                $settingType = $data::getSettingsNamesArray()[$data->premise_type];
                return ($data->id == Yii::$app->configManager->getItemValue($settingType)) ? Yii::t('app', 'Used') : Yii::t('app', 'Not Used');
            },
            'contentOptions' => ['style' => 'width:100px;'],
            'cssCLasses' => [
                Yii::t('app', 'Used') => 'warning',
                Yii::t('app', 'Not Used') => 'primary',
            ],
        ],
        [
            'class' => ActionColumn::className(),
            'header' => Html::a(Yii::t('app', 'Disable stage'), ['clear-stage', 'settingType' => $model::getSettingsNamesArray()[$model::TYPE]], []),
            // 'header' => $model::TYPE,
            'contentOptions' => ['style' => 'width:80px;'],
            'template' => '{set-item} &nbsp; {delete}',
            'buttons' => [
                'set-item' => function ($url, $model) {                        
                    $settingType = $model::getSettingsNamesArray()[$model->premise_type];
                    return Html::a('<i class="fa fa-check"></i>', ['set-default-item', 'id' => $model->id, 'settingType' => $settingType], [
                        'title' => Yii::t('app', 'Set Default Item'),
                        'data' => [
                            'method' => 'post',
                            'confirm' => Yii::t('app', 'Do set storage item answer'),
                        ]
                    ]);
                },
            ],
        ],
    ],
]); ?>