<?php

use backend\modules\content\models\Premise;
use backend\widgets\SetColumn;
use common\models\Status;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Premise Advantage Items: {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = ['label' => Premise::getTitleByPremiseType()[$model->premise_type], 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_tabs', ['model' => $model]); ?>

<p class="text-right">
    <?= Html::a(Yii::t('app', 'Add Record'), ['create-advantage', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']); ?>
    <?= Html::a(Yii::t('app', 'Refresh Page'), ['advantages', 'id' => $model->id], ['class' => 'btn btn-info btn-sm']); ?>
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
            'attribute' => 'name',
            'contentOptions' => ['class' => 'text-wrap'],
            'format' => 'raw',
            'value' => function($data) {
                return Html::a($data->name, ['update-advantage', 'advantageId' => $data->id, []]);
            }
        ],
        'sort',
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
            'template' => '{delete-element}',
            'buttons' => [
                'delete-element' => function ($url, $model) {
                    return Html::a('<i class="fa fa-trash"></i>', ['delete-advantage', 'advantageId' => $model->id], [
                        'title' => Yii::t('app', 'delete-item'),
                        'data' => [
                            'method' => 'post',
                            'confirm' => Yii::t('app', 'Do delete answer'),
                        ]
                    ]);
                },
            ],
        ],
    ],
]); ?>