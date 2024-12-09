<?php
declare(strict_types=1);

namespace frontend\modules\content\models\query;

use backend\modules\content\models\query\DocumentCategoryQuery as backendDocumentCategoryQuery;
use frontend\traits\activeOfferedQueryTrait;

class DocumentCategoryQuery extends backendDocumentCategoryQuery
{
    use activeOfferedQueryTrait;
}
