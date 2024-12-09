<?php

use common\models\Status;

$time = time();
$houses = [];
$houses[1] = [
    'id' => 1,
    'name' => '1/1',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];

return $houses;