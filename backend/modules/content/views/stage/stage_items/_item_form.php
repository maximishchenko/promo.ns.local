<?php

use common\components\StagePosition;
use yii\bootstrap5\ActiveForm;
?>
<div class="product-form">

    <?php $form = ActiveForm::begin([
        'id' => 'stage-items-form',
    ]); ?>
    <?= $form->errorSummary($itemModel, ['class' => 'alert alert-danger']); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($itemModel, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($itemModel, 'position')->dropDownList(StagePosition::getStagePositionsArray(), []) ?>
            <?= $form->field($itemModel, 'sort')->textInput(['type' => 'number']) ?>
            <?= $form->field($itemModel, 'status')->checkbox() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($itemModel, 'comment')->textarea(['rows' => 6])->hint($itemModel->getAttributeHint('comment')) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>
</div>
<?= $this->render('//layouts/forms/_buttons', ['formId' => 'stage-items-form']); ?>
