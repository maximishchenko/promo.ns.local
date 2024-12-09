<?php
declare(strict_types=1);

namespace frontend\modules\content\models\query;

use backend\modules\content\models\query\PaymentQuery as backendPaymentQuery;
use frontend\traits\activeOfferedQueryTrait;

class PaymentQuery extends backendPaymentQuery
{
    use activeOfferedQueryTrait;
}
