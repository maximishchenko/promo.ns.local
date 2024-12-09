<?php

namespace frontend\modules\catalog\models\query;

use backend\modules\catalog\models\query\HouseQuery as backendHouseQuery;
use common\models\Status;
use frontend\modules\catalog\models\House;
use frontend\traits\activeOfferedQueryTrait;

class HouseQuery extends backendHouseQuery
{
    use activeOfferedQueryTrait;

    public function active()
    {
        return $this->andWhere([House::tableName() . '.status' => Status::STATUS_ACTIVE]);
    }

    public function galleryOrdered()
    {
        return $this->orderBy(['sort' => SORT_DESC]);
    }  
}
