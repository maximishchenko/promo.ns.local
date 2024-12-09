<?php

namespace frontend\modules\catalog\models\query;

use backend\modules\catalog\models\query\ApartmentQuery as backendApartment;
use common\models\ApartmentStatus;
use common\models\Status;
use frontend\modules\catalog\models\Apartment;

class ApartmentQuery extends backendApartment
{
    public function active()
    {
        return $this->andWhere([Apartment::tableName() . '.status' => Status::STATUS_ACTIVE]);
    }

    public function minFloor()
    {
        return $this->orderBy(['apartment_floor' => SORT_ASC]);
    }

    public function byLayout()
    {
        return $this->groupBy('layout_id');
    }

    public function forSale()
    {
        return $this->andWhere([Apartment::tableName() . '.sale_status' => [ApartmentStatus::STATUS_FREE, ApartmentStatus::STATUS_RESERVED]]);
    }
}
