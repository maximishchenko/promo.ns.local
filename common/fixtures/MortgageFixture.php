<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class MortgageFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\Mortgage';
    public $dataFile = __DIR__ . '/data/content/mortgage.php';
}