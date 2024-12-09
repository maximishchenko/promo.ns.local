<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class LayoutFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\catalog\models\Layout';
    public $dataFile = __DIR__ . '/data/catalog/layout.php';
    public $depends = [
        'common\fixtures\EntranceFixture',
    ];
}