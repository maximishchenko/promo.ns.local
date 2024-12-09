<?php

use backend\modules\content\models\GalleryUpload;
use backend\widgets\SingleImagePreviewWidget;
use yii\bootstrap5\ActiveForm;
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin([
        'id' => 'gallery-form',
        'options' => ['enctype' => 'multipart/form-data'],
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

                                <?= $form->field($model, 'period')->textInput(['maxlength' => true, 'class' => 'form-control datepicker']) ?>

                                <?= $form->field($model, 'house_id')->dropDownList($model->getHousesItems(), ['prompt' => ""]) ?>

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
                            <?= $form->field($model, 'files[]', ['template' => '{label}<br/> {input} {error}'])->fileInput(['multiple' => true]) ?>
                            <?php if(isset($model->uploads) && !empty($model->uploads)):?>
                            <ul style="margin: 0; padding: 0;">
                                <div id="sortable" class="row" data-url="<?= Yii::$app->urlManager->createAbsoluteUrl('/content/gallery/save-image-sort'); ?>">
                                    <?php foreach ($model->uploads as $k => $upload): ?>
                                        <?= SingleImagePreviewWidget::widget([
                                            'id' => $upload->id,
                                            'filePath' => $upload->getUrl(GalleryUpload::UPLOAD_PATH, $upload->file_name),
                                            'url' => 'delete-files',
                                            'fancyboxGalleryName' => "SingleProductImage",
                                        ]);
                                        ?>
                                    <?php endforeach; ?>
                                </div>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $('.datepicker').datepicker({
        autoclose: true,
        format: "mm.yyyy",
        language: 'ru',
        orientation: 'bottom',
        startView: "months", 
        minViewMode: "months"
    });
</script>
<?php $this->registerJsFile("@web/js/sortable.js"); ?>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'gallery-form']); ?>