<?php

namespace frontend\modules\catalog\models;

use backend\modules\catalog\models\House as backendHouse;
use common\models\Status;
use frontend\modules\catalog\models\query\HouseQuery;
use frontend\modules\content\models\Gallery;
use frontend\traits\cacheParamsTrait;
use yii\db\ActiveQuery;

class House extends backendHouse
{
    use cacheParamsTrait;

    const NO_IMAGE = '/static/sprite.svg#noimage';

    public static function find(): HouseQuery
    {
        return new HouseQuery(get_called_class());
    }

    public function getEntrances(): ActiveQuery
    {
        return $this->hasMany(Entrance::class, ['house_id' => 'id'])->onCondition([Entrance::tableName() . ".status" => Status::STATUS_ACTIVE]);
    }
    
    public function getGalleries(): ActiveQuery
    {
        return $this->hasMany(Gallery::class, ['house_id' => 'id'])->onCondition([Gallery::tableName() . ".status" => Status::STATUS_ACTIVE])->orderBy([Gallery::tableName() . ".sort" => SORT_DESC]);
    }

    public function getThumb(): string
    {
        if (!empty($this->image)) {
            return '/' . static::UPLOAD_PATH . $this->image;
        } else {
            return static::NO_IMAGE;
        }
    }
}
