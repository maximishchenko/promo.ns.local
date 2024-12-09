<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class EntranceFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\catalog\models\Entrance';
    public $dataFile = __DIR__ . '/data/catalog/entrance.php';
    public $depends = [
        'common\fixtures\HouseFixture',
    ];
}