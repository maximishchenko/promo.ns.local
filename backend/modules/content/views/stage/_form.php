<?php

use backend\modules\content\models\Stage;
use backend\widgets\SingleImagePreviewWidget;
use yii\bootstrap5\ActiveForm;
use vova07\imperavi\Widget;

?>

<div class="stage-form">

    <?php if (!$model->isNewRecord): ?>
        <?= $this->render('_tabs', ['model' => $model]); ?>
    <?php endif; ?>
    
    <div class="alert alert-info">
        Внимание для установки меток, отображаемых "кружками" на фронтальной части приложения перейдите на вкладку
        "Элементы баннера/стейджа". Будут отображены до 3-х элементов в статусе "Активен" в соответствии с параметрами их сортировки.<br/>
        Количество выводимых меток возможно переопределить в разделе "Управление -> Настройки -> Контент -> Максимальное количество меток",
        но необходимо учитывать, что указание слишком большого количества может повлиять на верстку элемента на фронтальной части приложения
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'stage-form'
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
                                <?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>
                                <?= $form->field($model, 'status')->checkbox() ?>
                            </div>
                            <div class="col-md-6">
                                <?php // echo $form->field($model, 'text')->textarea(['rows' => 6]) ?>

                                <?= $form->field($model, 'text')->widget(Widget::className(), [
                                    'settings' => [
                                        'lang' => 'ru',
                                        'minHeight' => 200,
                                        'options' => [
                                            'minHeight' => 300,
                                            'lang' => Yii::$app->language,
                                            'pastePlainText' => true,
                                            'paragraphize' => false,
                                            'formatting' => ['br', 'h2', 'strong'],
                                        ],

                                        // 'imageUpload' => Url::to(['article/image-upload']),
                                        // 'imageManagerJson' => Url::to(['article/image-upload']),
                                        // 'fileManagerJson' => Url::to(['article/files-get']),
                                        // 'validatorOptions' => ['maxSize' => 40000],    //макс. размер файла
                                        'pastePlainText' => true,
                                        'paragraphize' => false,
                                        // 'buttonSource' => true,

                                        // 'plugins' => [
                                        //     'clips',
                                        //     //'table',
                                        //     'video',
                                        //     //'fontsize',
                                        //     'fontcolor',
                                        //     //'fontfamily',
                                        //     'imagemanager',
                                        //     'filemanager',
                                        //     'fullscreen' => array(
                                        //         'js' => array('fullscreen.js',),
                                        //     ),
                                        // ]
                                    ]
                                ]); ?>

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
                                        'filePath' => $model->getUrl(Stage::UPLOAD_PATH, $model->image),
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

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'stage-form']); ?>