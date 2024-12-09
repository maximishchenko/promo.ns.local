<?php

use common\models\Status;

$time = time();
$mortgages = [];
$mortgages[1] = [
    'id' => 1,
    'name' => 'ИПОТЕКА С ГОСПОДДЕРЖКОЙ 7,7%',
    'text' => "null",
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$mortgages[2] = [
    'id' => 2,
    'name' => 'СЕМЕЙНАЯ ИПОТЕКА 5,7%',
    'text' => "null",
    'comment' => null,
    'sort' => 2,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$mortgages[3] = [
    'id' => 3,
    'name' => 'IT-ИПОТЕКА 4,7%',
    'text' => "null",
    'comment' => null,
    'sort' => 3,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$mortgages[4] = [
    'id' => 4,
    'name' => 'ИПОТЕКА НА ПАРКОВОЧНОЕ МЕСТО',
    'text' => "null",
    'comment' => null,
    'sort' => 4,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];


return $mortgages;