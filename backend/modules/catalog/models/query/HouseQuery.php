<?php
declare(strict_types=1);

namespace backend\modules\catalog\models\query;

use yii\db\ActiveRecord;

class HouseQuery extends \yii\db\ActiveQuery
{
    public function all($db = null): array | ActiveRecord
    {
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }
}
