<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class BankFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\Bank';
    public $dataFile = __DIR__ . '/data/content/bank.php';
}