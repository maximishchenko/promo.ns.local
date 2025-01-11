<?php
declare(strict_types=1);

namespace frontend\modules\content\models;

use backend\modules\content\models\Projects as backendProjects;
use frontend\modules\content\models\query\ProjectsQuery;
use frontend\traits\cacheParamsTrait;

class Projects extends backendProjects
{
    use cacheParamsTrait;
    
    const NO_IMAGE = '/static/sprite.svg#noimage';
    
    public static function find(): ProjectsQuery
    {
        return new ProjectsQuery(get_called_class());
    }

    public function getPreviewThumb()
    {
        return ($this->image) ? '/' . self::UPLOAD_PATH . $this->image : static::NO_IMAGE;
    }

    // public static function getActiveOffer()
    // {
    //     $offers = self::getDb()->cache(function() {
    //         return self::find()->active()->ordered()->all();
    //     }, Offer::getCacheDuration(), Offer::getCacheDependency());
    //     return $offers;
    // }
}