<?php
declare(strict_types=1);

namespace frontend\modules\content\models\query;

use backend\modules\content\models\query\GalleryQuery as backendGalleryQuery;
use frontend\traits\activeOfferedQueryTrait;

class GalleryQuery extends backendGalleryQuery
{
    use activeOfferedQueryTrait;
}
