<?php
declare(strict_types=1);

namespace frontend\modules\content\models;

use backend\modules\content\models\Offer as backendOffer;
use frontend\modules\content\models\query\OfferQuery;
use frontend\traits\cacheParamsTrait;


class Offer extends backendOffer
{
    use cacheParamsTrait;
    
    const NO_IMAGE = '/static/sprite.svg#noimage';
    
    public static function find(): OfferQuery
    {
        return new OfferQuery(get_called_class());
    }

    public function getPreviewThumb()
    {
        return ($this->preview_image) ? '/' . self::UPLOAD_PATH . $this->preview_image : static::NO_IMAGE;
    }

    public function getDescriptionThumb()
    {
        return ($this->description_image) ? '/' . self::UPLOAD_PATH . $this->description_image : static::NO_IMAGE;
    }

    public static function getActiveOffer()
    {
        $offers = self::getDb()->cache(function() {
            return self::find()->active()->ordered()->all();
        }, Offer::getCacheDuration(), Offer::getCacheDependency());
        return $offers;
    }
}
