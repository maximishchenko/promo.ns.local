<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class StageItemFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\StageItem';
    public $dataFile = __DIR__ . '/data/content/stage-item.php';
    public $depends = [
        'common\fixtures\StageFixture',
    ];
}