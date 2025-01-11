<?php
declare(strict_types=1);

namespace frontend\modules\content\models\query;

use backend\modules\content\models\query\ProjectsQuery as backendProjectsQuery;
use common\models\Status;

class ProjectsQuery extends backendProjectsQuery
{
    
    public function active()
    {
        return $this->andWhere(['status' => Status::STATUS_ACTIVE]);
    }
}
