<?php

use yii\bootstrap5\ActiveForm;
?>

<div class="entrance-form">

    <div class="alert alert-info">
        Внимание при указании наименования (номера) подъезда необходимо указывать только числовое значение.<br/>
        Т.е. при указании значения 1 на фронтальной части приложения будет отображено "Подъезд №1".
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'entrance-form'
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
                                <?= $form->field($model, 'house_id')->dropDownList($model->getHousesItems(), ['prompt' => ""]) ?>
                                <?= $form->field($model, 'sort')->textInput() ?>
                                <?= $form->field($model, 'has_commercial_floor')->checkbox() ?>
                                <?= $form->field($model, 'status')->checkbox() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'number')->textInput(['type' => 'number']) ?>
                                <?= $form->field($model, 'count_floors')->textInput(['type' => 'number']) ?>
                                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'entrance-form']); ?>