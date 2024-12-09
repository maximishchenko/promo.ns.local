<?php
declare(strict_types=1);

namespace frontend\modules\content\models;

use backend\modules\content\models\Premise as backendPremise;
use backend\modules\content\models\Parking as backendParking;
use backend\modules\content\models\Commercial as backendCommercial;
use backend\modules\content\models\Storage as backendStorage;
use frontend\modules\content\models\query\PremiseQuery;
use frontend\traits\cacheParamsTrait;

/**
 *
 * @property-read string $thumb
 * @property-read string $layoutThumb
 */
class Premise extends backendPremise
{
    use cacheParamsTrait;

    public static function find(): PremiseQuery
    {
        return new PremiseQuery(get_called_class());
    }

    /**
     * @param $row
     * @return backendPremise
     */
    public static function instantiate($row): backendPremise
    {
        switch ($row['premise_type']) {
            case backendParking::TYPE:
                return new Parking();
            case backendCommercial::TYPE:
                return new Commercial();
            case backendStorage::TYPE:
                return new Storage();
            default:
            return new self;
        }
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return '/' . self::UPLOAD_PATH . $this->image;
    }

    /**
     * @return string
     */
    public function getLayoutThumb(): string
    {
        return '/' . self::UPLOAD_PATH . $this->layout_image;
    }

    public static function getCommercialActiveItem($id)
    {
        $activeItem = self::getDb()->cache(function() use ($id) {
            return self::find()->active()->activeItem($id)->one();
        }, self::getCacheDuration(), self::getCacheDependency());
        return $activeItem;
    }

    public static function getCommercialStages($id) 
    {
        $stages = self::getDb()->cache(function() use ($id) {
            return self::find()->active()->onlyCommercial()->stages($id)->all();
        }, self::getCacheDuration(), self::getCacheDependency());
        return $stages;
    }

    public static function getStorageActiveItem($id)
    {
        $activeItem = self::getDb()->cache(function() use ($id) {
            return self::find()->onlyStorage()->active()->activeItem($id)->one();
        }, self::getCacheDuration(), self::getCacheDependency());
        return $activeItem;
    }

    public static function getStorageStages($id)
    {
        $stages = self::getDb()->cache(function() use ($id) {
            return self::find()->active()->onlyStorage()->stages($id)->all();
        }, self::getCacheDuration(), self::getCacheDependency());
        return $stages;
    }

    public static function getParkingActiveItem($id)
    {
        $activeItem = self::getDb()->cache(function() use ($id) {
            return self::find()->onlyParking()->active()->activeItem($id)->one();
        }, self::getCacheDuration(), self::getCacheDependency());
        return $activeItem;
    }

    public static function getParkingStages($id)
    {
        $stages = self::getDb()->cache(function() use ($id) {
            return self::find()->active()->onlyParking()->stages($id)->all();
        }, self::getCacheDuration(), self::getCacheDependency());
        return $stages;
    }
}