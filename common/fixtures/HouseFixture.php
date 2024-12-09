<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class HouseFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\catalog\models\House';
    public $dataFile = __DIR__ . '/data/catalog/house.php';
}