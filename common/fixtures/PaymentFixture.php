<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class PaymentFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\Payment';
    public $dataFile = __DIR__ . '/data/content/payment.php';
}