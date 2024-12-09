<?php

namespace backend\widgets;

use backend\modules\management\models\User;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Отображает изображение предварительного просмотра
 * загруженного файла, добавляет кнопку удаления
 */
class SingleImagePreviewWidget extends Widget
{
    /**
     *
     * @var int id записи в БД, содержащей изображение, подставляется в ссылку удаления файла
     */
    public $id = null;

    /**
     *
     * @var string Полный путь к файлу, подставляется в тэг <img>
     */
    public $filePath;

    /**
     *
     * @var string метод удаления файла
     */
    public $url = null;

    public $fancyboxGalleryName = "gallery";

    public function init()
    {
        parent::init();
    }

    public function run()
    {
    ?>

        <div class='col-md-3' id="<?= $this->id; ?>" style="display: inline-block;">
            <li class="sortable__items">
                <a data-caption='' data-fancybox="<?= $this->fancyboxGalleryName; ?>" href="<?= $this->filePath; ?>" >
                    <img width='100%' src="<?= $this->filePath; ?>" >
                </a>            
            </li>
            <?php if (isset($this->url) && !empty($this->url) && isset($this->id) && !empty($this->id)): ?>
                <?php // echo Html::a('<i class="fa fa-trash"></i>', [$this->url, 'id' => $this->id], ['class' => 'btn btn-danger img__delete__btn', 'data-confirm' => Yii::t('app', 'DO DELETE ANSWER'), 'data-method' => 'post']); ?>
                <?= Html::a('<i class="fa fa-trash"></i>', [$this->url, 'id' => $this->id], ['class' => 'btn btn-danger img__delete__btn', 'data-confirm' => Yii::t('app', 'Do delete image answer'), 'data-method' => 'post']); ?>
            <?php endif; ?>
        </div>
    <?php
    }
}