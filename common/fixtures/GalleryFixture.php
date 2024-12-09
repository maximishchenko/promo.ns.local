<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class GalleryFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\Gallery';
    public $dataFile = __DIR__ . '/data/content/gallery.php';
}