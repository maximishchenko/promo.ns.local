<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class ApartmentFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\catalog\models\Apartment';
    public $dataFile = __DIR__ . '/data/catalog/apartment.php';
    public $depends = [
        'common\fixtures\LayoutFixture',
    ];
}