<?php

use backend\modules\content\models\Document;
use backend\widgets\SingleImagePreviewWidget;
use common\models\Files;
use yii\bootstrap5\ActiveForm;
?>
<div class="product-form">

    <?php $form = ActiveForm::begin([
        'id' => 'documents-form',
    ]); ?>
    <?= $form->errorSummary($documentModel, ['class' => 'alert alert-danger']); ?>

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
                                <?= $form->field($documentModel, 'name')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($documentModel, 'sort')->textInput(['type' => 'number']) ?>
                                <?= $form->field($documentModel, 'status')->checkbox() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($documentModel, 'comment')->textarea(['rows' => 6])->hint($documentModel->getAttributeHint('comment')) ?>
                            </div>
                        </div>
                </div>
            </div>
        </div>

<div class="accordion-item">
    <h2 class="accordion-header" id="headImages">
        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#imagesBlock" aria-expanded="true" aria-controls="imagesBlock">
            <strong>
                <?= Yii::t('app', 'Upload Files'); ?>
            </strong>
        </button>
    </h2>
    <div id="imagesBlock" class="accordion-collapse collapse show" aria-labelledby="headImages" data-bs-parent="#backendAccordion">
        <div class="accordion-body">

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($documentModel, 'file')->fileInput() ?>
                    <?php if(isset($documentModel->file_name) && !empty($documentModel->file_name)): ?>
                        <div class="row">
                            <a href="/<?= Document::UPLOAD_PATH . $documentModel->file_name; ?>" target="_blank">
                                <i class="fa fa-file fa-10x"></i>
                            </a>
                            <?= $documentModel->file_name; ?>
                            <br>
                            <?= Files::convertBytes($documentModel->file_size); ?>
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
<?= $this->render('//layouts/forms/_buttons', ['formId' => 'documents-form']); ?>
