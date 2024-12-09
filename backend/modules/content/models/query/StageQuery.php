<?php

declare(strict_types=1);

namespace backend\modules\content\models\query;

use yii\{db\ActiveQuery, db\ActiveRecord};

class StageQuery extends ActiveQuery
{
    /**
     * @param $db
     * @return array|ActiveRecord|ActiveRecord[]|null
     */
    public function all($db = null): null | array | ActiveRecord
    {
        return parent::all($db);
    }

    /**
     * @param $db
     * @return array|ActiveRecord|null
     */
    public function one($db = null): null | array | ActiveRecord
    {
        return parent::one($db);
    }
}
