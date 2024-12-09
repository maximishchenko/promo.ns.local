<?php

return [
    'name' => 'Новострой',
    'timezone'=> 'Europe/Moscow',
    'language' => 'ru-RU',

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => [
        'configManager',        
        'queue',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [        
        'telegram' => [
            'class' => 'aki\telegram\Telegram',
            'botToken' => '',
        ],
        'queue' => [
            'class' => \yii\queue\file\Queue::class,
            'path' => '@console/runtime/queue',
            'as log' => \yii\queue\LogBehavior::class,
        ],
        'configManager' => [
            'class' => yii2tech\config\Manager::class,
            'autoRestoreValues' => true,
            'cacheDuration' => 3600,
            'storage' => [
                'class' => 'yii2tech\config\StoragePhp',
                'fileName' => "@frontend/runtime/app_config.php",
            ],
            'items' => [
                'contactPhone' => [
                    'path' => 'phone',
                    'label' => Yii::t('app', "CONTACT_PHONE"),
                    'description' => Yii::t('app', "CONTACT_PHONE DESCRIPTION"),
                    'value' => "+7 (987) 654-32-10",
                    'rules' => [
                        ['required']
                    ],
                    'inputOptions' => [
                        'type' => 'phone',
                    ],
                ],
                'contactEmail' => [
                    'path' => 'email',
                    'label' => Yii::t('app', "CONTACT_EMAIL"),
                    'description' => Yii::t('app', "CONTACT_EMAIL DESCRIPTION"),
                    'value' => "info@company.org",
                    'rules' => [
                        ['required'],
                        ['email']
                    ],
                ],
                'contactAddress' => [
                    'path' => 'address',
                    'label' => Yii::t('app', "CONTACT_ADDRESS"),
                    'description' => Yii::t('app', "CONTACT_ADDRESS DESCRIPTION"),
                    'value' => "Ставропольский край, г. Минеральные Воды пр-кт 22 Партсъезда, 96/1, офис 1",
                    'rules' => [
                        ['required'],
                    ],
                    'inputOptions' => [
                        'type' => 'textarea',
                    ],
                ],
                'contentMainStage' => [
                    'path' => 'main_stage',
                    'label' => Yii::t('app', "CONTENT_MAIN_STAGE"),
                    'description' => Yii::t('app', "CONTENT_MAIN_STAGE DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                ],
                'contentParkingStage' => [
                    'path' => 'parking_stage',
                    'label' => Yii::t('app', "CONTENT_PARKING_STAGE"),
                    'description' => Yii::t('app', "CONTENT_PARKING_STAGE DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                ],
                'contentStorageStage' => [
                    'path' => 'storage_stage',
                    'label' => Yii::t('app', "CONTENT_STORAGE_STAGE"),
                    'description' => Yii::t('app', "CONTENT_STORAGE_STAGE DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                ],
                'contentCommercialStage' => [
                    'path' => 'commercial_stage',
                    'label' => Yii::t('app', "CONTENT_COMMERCIAL_STAGE"),
                    'description' => Yii::t('app', "CONTENT_COMMERCIAL_STAGE DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                ],
                'contentMainStageMaxItemsCount' => [
                    'path' => 'main_stage_max_items_count',
                    'label' => Yii::t('app', "CONTENT_MAIN_STAGE_MAX_ITEMS_COUNT"),
                    'description' => Yii::t('app', "CONTENT_MAIN_STAGE_MAX_ITEMS_COUNT DESCRIPTION"),
                    'value' => 3,
                    'rules' => [
                        ['required'],
                    ],
                ],
                'seoDefaultKeywords' => [
                    'path' => 'seo_keywords',
                    'label' => Yii::t('app', "SEO_KEYWORDS"),
                    'description' => Yii::t('app', "SEO_KEYWORDS KEYWORDS"),
                    'value' => "Новострой",
                    'rules' => [
                    ],
                ],
                'seoDefaultDescription' => [
                    'path' => 'seo_description',
                    'label' => Yii::t('app', "SEO_DESCRIPTION"),
                    'description' => Yii::t('app', "SEO_DESCRIPTION DESCRIPTION"),
                    'value' => "Новострой",
                    'rules' => [
                    ],
                    'inputOptions' => [
                        'type' => 'textarea',
                    ],
                ],
                'isWebSiteOffline' => [
                    'path' => 'is_website_offline',
                    'label' => Yii::t('app', "IS_WEBSITE_OFFLINE"),
                    'description' => Yii::t('app', "IS_WEBSITE_OFFLINE DESCRIPTION"),
                    'value' => false,
                    'rules' => [
                    ],
                    'inputOptions' => [
                        'type' => 'checkbox',
                    ],
                ],

                'reportTelegramChatID' => [
                    'path' => 'report_telegram_chat_id',
                    'label' => Yii::t('app', "REPORT_TELEGRAM_CHAT_ID"),
                    'description' => Yii::t('app', "REPORT_TELEGRAM_CHAT_ID DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                ],

                'reportEmail' => [
                    'path' => 'report_email',
                    'label' => Yii::t('app', "REPORT_Email"),
                    'description' => Yii::t('app', "REPORT_Email DESCRIPTION"),
                    'value' => "novostroy.ooo@yandex.ru",
                    'rules' => [
                    ],
                ],

                'catalogItemsPerPage' => [
                    'path' => 'catalog_items_per_page',
                    'label' => Yii::t('app', "Catalog Items Per Page"),
                    'description' => Yii::t('app', "Catalog Items Per Page DESCRIPTION"),
                    'value' => 8,
                    'rules' => [
                    ],
                    'inputOptions' => [
                        'type' => 'number',
                    ],
                ],
                'location' => [
                    'path' => 'location',
                    'label' => Yii::t('app', "Location"),
                    'description' => Yii::t('app', "Location DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                ],
                'mapApiKey' => [
                    'path' => 'mapApiKey',
                    'label' => Yii::t('app', "MAP API KEY"),
                    'description' => Yii::t('app', "MAP API KEY DESCRIPTION"),
                    'value' => "",
                    'rules' => [
                    ],
                ],
                'anotherProjectsUrl' => [
                    'path' => 'anotherProjectsUrl',
                    'label' => Yii::t('app', "Another Projects Url"),
                    'description' => Yii::t('app', "Another Projects Url DESCRIPTION"),
                    'value' => "http://yandex.ru",
                    'rules' => [
                        ['required'],
                        ['url']
                    ],
                ],


            ],
        ],

        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
];
