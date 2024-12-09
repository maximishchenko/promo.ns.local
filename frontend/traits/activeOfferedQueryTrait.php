<?php

namespace frontend\traits;

use common\models\Status;

trait activeOfferedQueryTrait
{
    public function active()
    {
        return $this->andWhere(['status' => Status::STATUS_ACTIVE]);
    }

    public function ordered()
    {
        return $this->orderBy(['sort' => SORT_ASC]);
    }  
}