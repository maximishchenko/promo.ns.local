<?php

use common\models\Status;

$time = time();
$offers = [];
$offers[1] = [
    'id' => 1,
    'name' => 'Беспроцентная рассрочка',
    'slug' => 'besprocentnaa-rassrocka',
    'preview_text' => 'Подробности уточняйте в отделе продаж',
    'preview_image' => null,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$offers[2] = [
    'id' => 2,
    'name' => '0₽ первоначальный взнос',
    'slug' => '0-pervonachalniy-vznos',
    'preview_text' => 'Подробности уточняйте в отделе продаж',
    'preview_image' => null,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$offers[3] = [
    'id' => 3,
    'name' => 'Ипотека 0,01%',
    'slug' => 'ipoteka-0-01percent',
    'preview_text' => 'Подробности уточняйте в отделе продаж',
    'preview_image' => null,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$offers[4] = [
    'id' => 4,
    'name' => 'Умная колонка при покупке квартиры',
    'slug' => 'smart-speaker-when-buy',
    'preview_text' => 'Подробности уточняйте в отделе продаж',
    'preview_image' => null,
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];

return $offers;