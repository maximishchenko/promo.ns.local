<?php

use backend\modules\management\models\Setting;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $models yii2tech\config\Item[] */

$this->title = Yii::t('app', 'SETTINGS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MANAGEMENT_MODULE'), 'url' => ['/management']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
            'id' => 'settings-form'
        ]); ?>

        <p class="text-right">
            <?= Html::a(Yii::t('app', 'Config Restore defaults'), ['default'], ['class' => 'btn btn-warning btn-sm', 'data-confirm' => Yii::t('app', 'Are you sure you want to restore default values?')]); ?>
        </p>

        <ul class="nav nav-tabs" id="settingsTabs" role="tablist">

            <?php foreach (array_keys(Setting::getTabsArray()) as $k => $tab): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($k == 0) ? 'active' : null; ?>" id="<?= $tab; ?>-tab" data-toggle="tab" href="#<?= $tab; ?>" role="tab" aria-controls="<?= $tab; ?>" aria-selected="true">
                        <?= Setting::getTabsArray()[$tab]; ?>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>

        <div class="tab-content" id="settingsTabsContent" style="margin-top: 50px;">

            <?php foreach (array_keys(Setting::getTabsArray()) as $k => $tab): ?>
                <div class="tab-pane fade show <?= ($k == 0) ? 'active' : null; ?>" id="<?= $tab; ?>" role="tabpanel" aria-labelledby="<?= $tab; ?>-tab">
                    <div class="row">



                        <?php foreach ($models as $key => $model): ?>
                            <?php if (in_array($model->path, Setting::getTabsItems()[$tab])): ?>
                            
                                <div class="col-md-4">

                                    <?php
                                    $field = $form->field($model, "[{$key}]value")->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
                                    $inputType = ArrayHelper::remove($model->inputOptions, 'type');
                                    switch($inputType) {
                                        case 'phone':
                                            $field->widget(\yii\widgets\MaskedInput::className(), [
                                                'mask' => '+7 (999) 999-99-99',
                                            ])->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
                                            break;
                                        case 'checkbox':
                                            $field->checkbox()->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
                                            break;
                                        case 'textarea':
                                            $field->textarea()->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
                                            break;
                                        case 'dropDown':
                                            $field->dropDownList($model->inputOptions['items'], $model->inputOptions['params'])->label(Yii::t('app', $model->label))->hint(Yii::t('app', $model->description));
                                            break;
                                    }
                                    echo $field;
                                    ?>
                                
                                </div>

                            <?php endif; ?>
                        <?php endforeach;?>


                    </div>
                </div>
            <?php endforeach; ?>
        
        </div>

<?php ActiveForm::end(); ?>


<?= $this->render('//layouts/forms/_buttons', ['formId' => 'settings-form']); ?>