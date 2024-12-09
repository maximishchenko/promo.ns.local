<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class OfferFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\Offer';
    public $dataFile = __DIR__ . '/data/content/offer.php';
}