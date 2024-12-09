<?php

namespace common\models;

use Yii;

class Status
{
    const STATUS_ACTIVE = 1;

    const STATUS_BLOCKED = 0;

    public static function getStatusesArray(): array
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Status Active'),
            self::STATUS_BLOCKED => Yii::t('app', 'Status Blocked'),
        ];
    }
}