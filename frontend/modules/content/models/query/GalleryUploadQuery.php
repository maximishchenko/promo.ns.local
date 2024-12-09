<?php
declare(strict_types=1);

namespace frontend\modules\content\models\query;

use backend\modules\content\models\query\GalleryUploadQuery as backendGalleryUploadQuery;
use frontend\traits\activeOfferedQueryTrait;

class GalleryUploadQuery extends backendGalleryUploadQuery
{
    use activeOfferedQueryTrait;
}
