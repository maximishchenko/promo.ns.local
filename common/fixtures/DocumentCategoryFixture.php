<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class DocumentCategoryFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\content\models\DocumentCategory';
    public $dataFile = __DIR__ . '/data/content/document-category.php';
}