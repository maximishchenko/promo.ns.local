<?php

namespace frontend\modules\catalog\models\query;

use backend\modules\catalog\models\query\LayoutQuery as backendLayoutQuery;

class LayoutQuery extends backendLayoutQuery
{
    public function minRooms(): ?string
    {
        return $this->min('count_rooms');
    }

    public function maxRooms(): ?string
    {
        return $this->max('count_rooms');
    }
}
