<?php

use common\models\Status;

$time = time();
$stages = [];
$stages[1] = [
    'id' => 1,
    'name' => 'Квартиры в ипотеку от 13432 руб.',
    'image' => null,
    'text' => "Квартиры в ипотеку от&nbsp;13&nbsp;432&nbsp;₽ в&nbsp;ЖК&nbsp;Новый&nbsp;Город",
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$stages[2] = [
    'id' => 2,
    'name' => 'Квартиры вместе с хозяином',
    'image' => null,
    'text' => null,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_BLOCKED,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$stages[3] = [
    'id' => 3,
    'name' => 'Квартиры в ассортименте',
    'image' => null,
    'text' => null,
    'comment' => null,
    'sort' => 3,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];

return $stages;