<?php

declare(strict_types=1);

namespace frontend\modules\content\models;

use frontend\modules\content\models\query\GalleryUploadQuery;
use backend\modules\content\models\GalleryUpload as backendGalleryUpload;
use yii\db\ActiveQuery;

/**
 *
 * @property-read string $image
 */
class GalleryUpload extends backendGalleryUpload
{

    /**
     * @return ActiveQuery
     */
    public function getGallery(): ActiveQuery
    {
        return $this->hasOne(Gallery::class, ['id' => 'gallery_id']);
    }

    /**
     * @return GalleryUploadQuery
     */
    public static function find(): GalleryUploadQuery
    {
        return new GalleryUploadQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return '/' . self::UPLOAD_PATH . $this->file_name;
    }
}
