<?php

use common\models\Status;

$time = time();
$payments = [];
$payments[1] = [
    'id' => 1,
    'name' => 'Ипотека',
    'image' => null,
    'comment' => null,
    'text' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$payments[2] = [
    'id' => 2,
    'name' => 'Рассрочка',
    'image' => null,
    'comment' => null,
    'text' => null,
    'sort' => 2,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$payments[3] = [
    'id' => 3,
    'name' => 'Материнский капитал',
    'image' => null,
    'comment' => null,
    'text' => null,
    'sort' => 3,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
return $payments;