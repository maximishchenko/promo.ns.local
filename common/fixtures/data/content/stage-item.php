<?php

use common\models\Status;

$time = time();
$stageItems = [];
$stageItems[1] = [
    'id' => 1,
    'name' => 'Льготная ипотека',
    'stage_id' => 1,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$stageItems[2] = [
    'id' => 2,
    'name' => 'Парковки под навесом',
    'stage_id' => 1,
    'comment' => null,
    'sort' => 2,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$stageItems[3] = [
    'id' => 3,
    'name' => 'Закрытая территория',
    'stage_id' => 1,
    'comment' => null,
    'sort' => 2,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$stageItems[4] = [
    'id' => 4,
    'name' => 'Злая собака',
    'stage_id' => 2,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$stageItems[5] = [
    'id' => 5,
    'name' => 'Злая вахтерша',
    'stage_id' => 2,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$stageItems[6] = [
    'id' => 6,
    'name' => 'Злая собака',
    'stage_id' => 3,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$stageItems[7] = [
    'id' => 7,
    'name' => 'Злая вахтерша',
    'stage_id' => 3,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];

return $stageItems;