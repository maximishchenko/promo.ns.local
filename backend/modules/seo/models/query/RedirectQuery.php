<?php
declare(strict_types=1);

namespace backend\modules\seo\models\query;


class RedirectQuery extends \yii\db\ActiveQuery
{
    public function all($db = null)
    {
        return parent::all($db);
    }
    
    public function one($db = null): mixed
    {
        return parent::one($db);
    }
}
