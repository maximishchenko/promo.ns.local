<?php

use common\models\Status;

$time = time();
$documentCategory = [];
$documentCategory[1] = [
    'id' => 1,
    'name' => 'Общие документы',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$documentCategory[2] = [
    'id' => 2,
    'name' => 'Литер 4 корпус 3',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];

return $documentCategory;