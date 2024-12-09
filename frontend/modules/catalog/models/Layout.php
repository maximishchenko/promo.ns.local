<?php

namespace frontend\modules\catalog\models;

use common\models\ApartmentStatus;
use common\models\Status;
use frontend\modules\catalog\models\query\LayoutQuery;
use frontend\traits\cacheParamsTrait;
use backend\modules\catalog\models\Layout as backendLayout;
use yii\helpers\ArrayHelper;

class Layout extends backendLayout
{
    use cacheParamsTrait;

    const NO_IMAGE = '/static/sprite.svg#noimage';

    public static function find(): LayoutQuery
    {
        return new LayoutQuery(get_called_class());
    }

    public function getThumb(): string
    {
        return (isset($this->image) && !empty($this->image)) ? '/' . static::UPLOAD_PATH . $this->image : static::NO_IMAGE;
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function getApartmentRoomsCount(): array
    {
        $rooms = self::getDb()->cache(function() {
            return self::find()->select(['count_rooms'])->distinct()->asArray()->all();
        }, self::getCacheDuration(), self::getCacheDependency());
        return ArrayHelper::getColumn($rooms, 'count_rooms');
    }
}
