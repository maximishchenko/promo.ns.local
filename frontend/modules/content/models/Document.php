<?php
declare(strict_types=1);

namespace frontend\modules\content\models;

use frontend\modules\content\models\query\DocumentQuery;
use backend\modules\content\models\Document as backendDocument;
use yii\db\ActiveQuery;


/**
 *
 * @property-read string $filePath
 */
class Document extends backendDocument
{
    /**
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(DocumentCategory::class, ['id' => 'category_id']);
    }

    /**
     * @return DocumentQuery
     */
    public static function find(): DocumentQuery
    {
        return new DocumentQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return "/" . self::UPLOAD_PATH . $this->file_name;
    }
}
