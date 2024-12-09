<?php
declare(strict_types=1);

namespace frontend\modules\content\models;

use backend\modules\content\models\Payment as backendPayment;
use frontend\modules\content\models\query\PaymentQuery;
use frontend\traits\cacheParamsTrait;

class Payment extends backendPayment
{
    use cacheParamsTrait;

    public static function find(): PaymentQuery
    {
        return new PaymentQuery(get_called_class());
    }

    public function getImagePath(): string
    {
        return "/" . self::UPLOAD_PATH . $this->image;
    }
}
