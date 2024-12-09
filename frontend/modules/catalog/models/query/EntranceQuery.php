<?php

namespace frontend\modules\catalog\models\query;

use backend\modules\catalog\models\query\EntranceQuery as backendEntranceQuery;
use frontend\traits\activeOfferedQueryTrait;

class EntranceQuery extends backendEntranceQuery
{
    use activeOfferedQueryTrait;
}
