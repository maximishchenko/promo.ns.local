<?php

use common\models\Status;

$time = time();
$layouts = [];
// Планировки 1й подъезд
$layouts[1] = [
    'id' => 1,
    'entrance_id' => 1,
    'image' => null,
    'count_rooms' => 1,
    'total_area' => 40.5,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$layouts[2] = [
    'id' => 2,
    'entrance_id' => 1,
    'image' => null,
    'count_rooms' => 2,
    'total_area' => 60.35,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$layouts[3] = [
    'id' => 3,
    'entrance_id' => 1,
    'image' => null,
    'count_rooms' => 3,
    'total_area' => 80.00,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];


// Планировки 2й подъезд
$layouts[4] = [
    'id' => 4,
    'entrance_id' => 2,
    'image' => null,
    'count_rooms' => 1,
    'total_area' => 30.5,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$layouts[5] = [
    'id' => 5,
    'entrance_id' => 2,
    'image' => null,
    'count_rooms' => 2,
    'total_area' => 50.35,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$layouts[6] = [
    'id' => 6,
    'entrance_id' => 2,
    'image' => null,
    'count_rooms' => 3,
    'total_area' => 70.00,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];




return $layouts;