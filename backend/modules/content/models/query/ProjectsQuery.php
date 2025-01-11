<?php

declare(strict_types=1);

namespace backend\modules\content\models\query;

use yii\db\ActiveQuery;

class ProjectsQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }
    
    public function all($db = null)
    {
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }
}
