<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class ListButtonsWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        echo Html::a(Yii::t('app', 'Add Record'), ['create'], ['class' => 'btn btn-success btn-sm']);
        echo Html::a(Yii::t('app', 'Refresh Page'), ['index'], ['class' => 'btn btn-info btn-sm', 'style' => "margin-left: 10px"]);
    }
}