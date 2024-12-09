<?php

use yii\bootstrap5\ActiveForm;
use vova07\imperavi\Widget;
?>

<div class="mortgage-form">

    <?php $form = ActiveForm::begin([
        'id' => 'mortgage-form'
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
                            <?php // $form->field($model, 'text')->textarea(['rows' => 6]) ?>
                            <?php
                            echo $form->field($model, 'text')->widget(Widget::className(), [
                                'settings' => [
                                    'lang' => 'ru',
                                    'minHeight' => 200,
                                    'plugins' => [
                                        'clips',
                                        'fullscreen',
                                    ],
                                    'clips' => [
                                        ['Lorem ipsum...', 'Lorem...'],
                                        ['red', '<span class="label-red">red</span>'],
                                        ['green', '<span class="label-green">green</span>'],
                                        ['blue', '<span class="label-blue">blue</span>'],
                                    ],
                                ],
                            ]);
                            ?>
                            <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'mortgage-form']); ?>