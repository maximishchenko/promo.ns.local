<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class PremiseFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\Premise';
    public $dataFile = __DIR__ . '/data/content/premise.php';
}