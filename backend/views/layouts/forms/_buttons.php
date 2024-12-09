<?php

use backend\widgets\SaveFormButtonsWidget;
use yii\helpers\Html;

 $this->beginBlock('buttons'); ?>
    <div class="form-group text-center">
        <?= SaveFormButtonsWidget::widget(['formId' => $formId]) ?>
    </div>
<?php $this->endBlock();  ?>