<?php

return [
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
            'keyPrefix' => 'file_cache',
            'defaultDuration' => 3600, 
        ],        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];
