<?php
declare(strict_types=1);

namespace backend\modules\catalog\models\query;

use backend\modules\catalog\models\Layout;

class LayoutQuery extends \yii\db\ActiveQuery
{
    public function all($db = null): ?array
    {
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }
}
