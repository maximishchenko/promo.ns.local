<?php
declare(strict_types=1);

namespace frontend\modules\content\models;

use backend\modules\content\models\StageItem as backendStageItem;
use frontend\traits\cacheParamsTrait;

class StageItem extends backendStageItem
{
    use cacheParamsTrait;
}