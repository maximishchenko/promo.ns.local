<?php

namespace common\models;
use Yii;

class ApartmentStatus
{
    const STATUS_FREE = 'free';

    const STATUS_SOLD = 'sold';

    const STATUS_RESERVED = 'reserved';

    const STATUS_FREE_CSS_CLASS = 'apartments-list__item--free';

    const STATUS_SOLD_CSS_CLASS = 'apartments-list__item--sold';

    const STATUS_RESERVED_CSS_CLASS = 'apartments-list__item--reserved';

    const SELECTED_ITEM_CSS_CLASS = 'apartments-list__item--selected';

    public static function getStatusesArray(): array
    {
        return [
            self::STATUS_FREE => Yii::t('app', 'Status Free'),
            self::STATUS_SOLD => Yii::t('app', 'Status Sold'),
            self::STATUS_RESERVED => Yii::t('app', 'Status Reserved'),
        ];
    }

    public static function getStatusesCssClassNames(): array
    {
        return [
            self::STATUS_FREE => self::STATUS_FREE_CSS_CLASS,
            self::STATUS_RESERVED => self::STATUS_RESERVED_CSS_CLASS,
            self::STATUS_SOLD => self::STATUS_SOLD_CSS_CLASS,
        ];
    }
}