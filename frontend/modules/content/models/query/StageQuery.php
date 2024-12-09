<?php

namespace frontend\modules\content\models\query;

use backend\modules\content\models\query\StageQuery as backendStageQuery;
use frontend\traits\activeOfferedQueryTrait;

class StageQuery extends backendStageQuery
{
    use activeOfferedQueryTrait;
}
