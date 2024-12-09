<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class LeadFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\Lead';
    public $dataFile = __DIR__ . '/data/content/lead.php';
}