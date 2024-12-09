<?php

declare(strict_types=1);

namespace backend\modules\content\models\query;

use yii\db\ActiveRecord;
use \yii\db\ActiveQuery;

class OfferQuery extends ActiveQuery
{
    
    public function all($db = null): array | ActiveRecord
    {
        return parent::all($db);
    }

    public function one($db = null): array | ActiveRecord
    {
        return parent::one($db);
    }
}
