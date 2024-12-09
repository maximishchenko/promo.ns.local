<?php

namespace frontend\traits;

use Yii;

trait cacheParamsTrait
{
    
    public static function getCacheDependency(): \yii\caching\Dependency
    {
        $queryString = "SELECT MAX(updated_at) FROM " . self::tableName(); 
        return new \yii\caching\DbDependency([
            'sql' => $queryString
        ]);
    }

    public static function getCacheDuration(): int
    {
        return Yii::$app->cache->defaultDuration;
    }
}