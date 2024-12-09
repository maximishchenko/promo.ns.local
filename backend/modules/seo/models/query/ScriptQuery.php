<?php

declare(strict_types=1);

namespace backend\modules\seo\models\query;


class ScriptQuery extends \yii\db\ActiveQuery
{
    public function all($db = null): mixed
    {
        return parent::all($db);
    }
    
    public function one($db = null): mixed
    {
        return parent::one($db);
    }
}
