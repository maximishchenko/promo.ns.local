<?php

declare(strict_types=1);

namespace backend\modules\content\models\query;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class GalleryQuery extends ActiveQuery
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
