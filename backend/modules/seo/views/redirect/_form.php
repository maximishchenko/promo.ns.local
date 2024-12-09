<?php

use backend\modules\seo\models\Redirect;
use yii\bootstrap5\ActiveForm;

?>

<div class="redirect-form">

<div class="container">


    <?php $form = ActiveForm::begin([
        'id' => 'redirect-form'
    ]); ?>
    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>

    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'source_url')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'redirect_code')->dropDownList(Redirect::getRedirectCodeArray(), []) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'destination_url')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'sort')->textInput() ?>
                <?= $form->field($model, 'status')->checkbox() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>
    
</div>

</div>
<?= $this->render('//layouts/forms/_buttons', ['formId' => 'redirect-form']); ?>
