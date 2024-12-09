<?php

use backend\modules\content\models\Bank;
use backend\widgets\SingleImagePreviewWidget;
use yii\bootstrap5\ActiveForm;
?>

<div class="bank-form">

    <?php $form = ActiveForm::begin([
        'id' => 'bank-form'
    ]); ?>    
    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>

    <div class="accordion" id="backendAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headPrimary">
                <button class="accordion-button" type="button" data-toggle="collapse" data-target="#primary" aria-expanded="true" aria-controls="primary">
                    <strong>
                        <?= Yii::t('app', 'Primary block'); ?>
                    </strong>
                </button>
            </h2>
            <div id="primary" class="accordion-collapse collapse show" aria-labelledby="headPrimary" data-bs-parent="#backendAccordion">
                <div class="accordion-body">


                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                
                                <?= $form->field($model, 'sort')->textInput() ?>

                                <?= $form->field($model, 'status')->checkbox() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                            </div>
                        </div>

                </div>
            </div>
        </div>

<div class="accordion-item">
    <h2 class="accordion-header" id="headImages">
        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#imagesBlock" aria-expanded="true" aria-controls="imagesBlock">
            <strong>
                <?= Yii::t('app', 'Upload Images'); ?>
            </strong>
        </button>
    </h2>
    <div id="imagesBlock" class="accordion-collapse collapse show" aria-labelledby="headImages" data-bs-parent="#backendAccordion">
        <div class="accordion-body">

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'imageFile')->fileInput() ?>
                    <?php if(isset($model->image) && !empty($model->image)): ?>
                        <div class="row">
                            <?= SingleImagePreviewWidget::widget([
                                'id' => $model->id,
                                'filePath' => $model->getUrl(Bank::UPLOAD_PATH, $model->image),
                                'url' => 'delete-image',
                                'fancyboxGalleryName' => "SingleCategoryImage",
                            ]); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>
    </div>



    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'bank-form']); ?>