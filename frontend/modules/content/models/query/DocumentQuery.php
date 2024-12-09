<?php
declare(strict_types=1);

namespace frontend\modules\content\models\query;

use backend\modules\content\models\query\DocumentQuery as backendDocumentQuery;
use frontend\traits\activeOfferedQueryTrait;

class DocumentQuery extends backendDocumentQuery
{
    use activeOfferedQueryTrait;
}
