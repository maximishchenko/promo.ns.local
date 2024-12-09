<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class StageFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\Stage';
    public $dataFile = __DIR__ . '/data/content/stage.php';
}