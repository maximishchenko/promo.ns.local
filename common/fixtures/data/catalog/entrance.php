<?php

use common\models\Status;

$time = time();
$entrance = [];
$entrance[1] = [
    'id' => 1,
    'house_id' => 1,
    'number' => 1,
    'count_floors' => 3,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$entrance[2] = [
    'id' => 2,
    'house_id' => 1,
    'number' => 2,
    'count_floors' => 2,
    'comment' => null,
    'sort' => 2,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];

return $entrance;