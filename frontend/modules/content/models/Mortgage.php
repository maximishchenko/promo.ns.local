<?php
declare(strict_types=1);

namespace frontend\modules\content\models;

use backend\modules\content\models\Mortgage as backendMortgage;
use frontend\modules\content\models\query\MortgageQuery;
use frontend\traits\cacheParamsTrait;

class Mortgage extends backendMortgage
{
    use cacheParamsTrait;

    public static function find(): MortgageQuery
    {
        return new MortgageQuery(get_called_class());
    }

    public static function getActiveMortgages()
    {
        $mortgages = self::getDb()->cache(function() {
            return self::find()->active()->all();
        }, self::getCacheDuration(), self::getCacheDependency());
        return $mortgages;
    }
}
