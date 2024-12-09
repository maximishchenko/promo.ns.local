<?php

use backend\modules\management\models\User;
use yii\bootstrap5\ActiveForm;

?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'users-form',
    ]); ?>

    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>

    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'newPassword')->passwordInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
                <?= $form->field($model, 'status')->dropDownList(User::getStatusesArray(), ['class' => 'form-control']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'users-form']); ?>