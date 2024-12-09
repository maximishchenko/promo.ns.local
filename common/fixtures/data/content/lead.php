<?php

$time = time();
$leads = [];
$leads[1] = [
    'id' => 1,
    'name' => 'Иванов Иван Иванович',
    'phone' => '+79123456789',
    'email' => null,
    'subject' => 'Сообщение формы обратной связи',
    'body' => 'Хочу квартиру',
    'created_at' => time(),
];
$leads[2] = [
    'id' => 2,
    'name' => 'Петров Петр Петрович',
    'phone' => '+79987654231',
    'email' => 'info@petrov.org',
    'subject' => 'Сообщение формы обратной связи',
    'body' => 'Хочу трешку',
    'created_at' => time(),
];
$leads[3] = [
    'id' => 3,
    'name' => 'Сидоров Сидор Сидорович',
    'phone' => '+79631234567',
    'email' => 'info@sidorov.org',
    'subject' => 'Сообщение формы обратной связи',
    'body' => 'Хочу двушку',
    'created_at' => time(),
];

return $leads;