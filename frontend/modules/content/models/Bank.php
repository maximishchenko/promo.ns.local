<?php
declare(strict_types=1);

namespace frontend\modules\content\models;

use backend\modules\content\models\Bank as backendBank;
use frontend\modules\content\models\query\BankQuery;
use frontend\traits\cacheParamsTrait;

class Bank extends backendBank
{
    use cacheParamsTrait;

    public static function find(): BankQuery
    {
        return new BankQuery(get_called_class());
    }

    public function getImagePath(): string
    {
        return "/" . self::UPLOAD_PATH . $this->image;
    }
}
