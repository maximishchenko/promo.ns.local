<?php
declare(strict_types=1);

namespace frontend\modules\content\models\query;

use backend\modules\content\models\query\MortgageQuery as backendMortgageQuery;
use frontend\traits\activeOfferedQueryTrait;

class MortgageQuery extends backendMortgageQuery
{
    use activeOfferedQueryTrait;
}
