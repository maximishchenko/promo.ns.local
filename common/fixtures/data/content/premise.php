<?php

use backend\modules\content\models\Commercial;
use backend\modules\content\models\Parking;
use backend\modules\content\models\Storage;
use common\models\Status;

$time = time();
$premises = [];
// Parking
$premises[1] = [
    'id' => 1,
    'premise_type' => Parking::TYPE,
    'name' => 'Успейте забронировать место в подземном паркинге по выгодной цене!',
    'image' => null,
    'layout_image' => null,
    'description' => "Всего от 258 руб. в день",
    'callback_button_name' => 'Купить',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$premises[2] = [
    'id' => 2,
    'premise_type' => Parking::TYPE,
    'name' => 'Защита от погодных условий',
    'image' => null,
    'layout_image' => null,
    'description' => "Автомобиль защищен от снега и дождя. Температура воздуха на парковке позволяет не прогревать машину зимой. Кузов автомобиля защищен от коррозии",
    'callback_button_name' => 'Подобрать машиноместо',
    'comment' => null,
    'sort' => 2,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$premises[3] = [
    'id' => 3,
    'premise_type' => Parking::TYPE,
    'name' => 'Получите экономию своего времени',
    'image' => null,
    'layout_image' => null,
    'description' => "Всегда свободное место для автомобиля. Расчистка от снега больше не требуется. Комфорт, безопасность и свобода передвижения",
    'callback_button_name' => 'Подобрать машиноместо',
    'comment' => null,
    'sort' => 3,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
// Storage
$premises[4] = [
    'id' => 4,
    'premise_type' => Storage::TYPE,
    'name' => 'Успейте забронировать место в подземном паркинге по выгодной цене!',
    'image' => null,
    'layout_image' => null,
    'description' => "Всего от 258 руб. в день",
    'callback_button_name' => 'Купить',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$premises[5] = [
    'id' => 5,
    'premise_type' => Storage::TYPE,
    'name' => 'Защита от погодных условий',
    'image' => null,
    'layout_image' => null,
    'description' => "Автомобиль защищен от снега и дождя. Температура воздуха на парковке позволяет не прогревать машину зимой. Кузов автомобиля защищен от коррозии",
    'callback_button_name' => 'Подобрать машиноместо',
    'comment' => null,
    'sort' => 2,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$premises[6] = [
    'id' => 6,
    'premise_type' => Storage::TYPE,
    'name' => 'Получите экономию своего времени',
    'image' => null,
    'layout_image' => null,
    'description' => "Всегда свободное место для автомобиля. Расчистка от снега больше не требуется. Комфорт, безопасность и свобода передвижения",
    'callback_button_name' => 'Подобрать машиноместо',
    'comment' => null,
    'sort' => 3,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
// Commercial
$premises[7] = [
    'id' => 7,
    'premise_type' => Commercial::TYPE,
    'name' => 'Успейте забронировать место в подземном паркинге по выгодной цене!',
    'image' => null,
    'layout_image' => null,
    'description' => "Всего от 258 руб. в день",
    'callback_button_name' => 'Купить',
    'comment' => null,
    'sort' => 1,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$premises[8] = [
    'id' => 8,
    'premise_type' => Commercial::TYPE,
    'name' => 'Защита от погодных условий',
    'image' => null,
    'layout_image' => null,
    'description' => "Автомобиль защищен от снега и дождя. Температура воздуха на парковке позволяет не прогревать машину зимой. Кузов автомобиля защищен от коррозии",
    'callback_button_name' => 'Подобрать машиноместо',
    'comment' => null,
    'sort' => 2,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];
$premises[9] = [
    'id' => 9,
    'premise_type' => Commercial::TYPE,
    'name' => 'Получите экономию своего времени',
    'image' => null,
    'layout_image' => null,
    'description' => "Всегда свободное место для автомобиля. Расчистка от снега больше не требуется. Комфорт, безопасность и свобода передвижения",
    'callback_button_name' => 'Подобрать машиноместо',
    'comment' => null,
    'sort' => 3,
    'status' => Status::STATUS_ACTIVE,
    'created_at' => time(),
    'updated_at' => time(),
    'created_by' => null,
    'updated_by' => null,
];

return $premises;