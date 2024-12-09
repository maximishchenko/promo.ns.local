<?php
declare(strict_types=1);

namespace frontend\modules\content\models\query;

use backend\modules\content\models\query\BankQuery as backendBankQuery;
use frontend\traits\activeOfferedQueryTrait;

class BankQuery extends backendBankQuery
{
    use activeOfferedQueryTrait;
}
