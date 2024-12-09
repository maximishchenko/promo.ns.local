<?php

use common\models\Status;

$time = time();
$gallery = [];
$gallery[1] = [
    'id' => 1,
    'name' => 'Март 2023 — Литер 3/1',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$gallery[2] = [
    'id' => 2,
    'name' => 'Июнь 2023 — Литер 3/1',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$gallery[3] = [
    'id' => 3,
    'name' => 'Июль 2023 — Литер 3/1',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$gallery[3] = [
    'id' => 3,
    'name' => 'Август 2023 — Литер 3/1',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];

return $gallery;