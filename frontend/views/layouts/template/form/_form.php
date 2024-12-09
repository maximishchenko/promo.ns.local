<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\content\models\Lead;

$contact = new Lead();
?>
   
  <?php $form = ActiveForm::begin([
      'id' => 'calback-form-modal',
      'action' => ['/feedback'],
      'method' => 'post',
      'options' => [
          'class' => "choose-feedback__form ajax_form",
          'data-feedback-form' => '',
      ],
      'enableAjaxValidation' => false,
      'enableClientValidation' => false,
      'enableClientScript' => false,
  ]); ?>

    <div class="choose-feedback__form-info">

      <?= $form->field($contact, 'subject', ['template' => '{input}'])->textInput(['placeholder' => 'Тема', 'value' => Lead::FEEDBACK_CONTACT_FORM_SUBJECT, 'hidden' => true])?>
      
      <div class="input-group">
          <?= $form->field($contact, 'name', ['template' => '{input}'])->textInput(['placeholder' => 'Имя', 'required' => ''])?>
      </div>

      <div class="choose-feedback__inputs">
        <div class="input-group">
          <?= $form->field($contact, 'phone', ['template' => '{input}'])->textInput(['placeholder' => 'Телефон', 'required' => '', 'data-tel-input' => ''])?>
          <span class="error_f_phone"></span>
        </div>
      </div>

      <div class="choose-feedback__inputs">
        <div class="input-group">
          <?= $form->field($contact, 'body', ['template' => '{input}'])->textarea(['placeholder' => 'Комментарий', 'required' => ''])?>
        </div>
      </div>

      <div class="policy">
        Нажимая кнопку «Отправить», вы подтверждаете свое 
        <a href="/policy">согласие</a> на обработку персональных данных
      </div>
    </div>
    <?php $buttonText = "<div class='send-btn__icon'></div><div class='send-btn__text'>Отправить</div>"; ?>
    <?= Html::submitButton($buttonText, ['class' => 'send-btn'])?>
  <?php ActiveForm::end(); ?>
    