<?php

namespace backend\modules\management\models;

use Yii;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $key
 * @property string|null $value
 * @property string|null $field_type
 * @property string|null $tab
 */
class Setting extends \yii\base\Model
{

    const TAB_CONTACT = 'contact';
    const TAB_SEO = 'seo';
    const TAB_GLOBAL = 'global';
    const TAB_CONTENT = 'content';

    public static function getTabsArray(): array
    {
        return [
            self::TAB_CONTACT => Yii::t('app', 'SETTING_CONTACT_TAB'),
            self::TAB_SEO => Yii::t('app', 'SETTING_SEO_TAB'),
            self::TAB_GLOBAL => Yii::t('app', 'SETTING_TAB_GLOBAL'),
            self::TAB_CONTENT => Yii::t('app', 'SETTING_TAB_CONTENT'),
        ];
    }

    public static function getTabsItems(): array
    {
        return [
            self::TAB_CONTACT => [
                'phone', 'email', 'address'
            ],
            self::TAB_SEO => [
                'seo_keywords', 'seo_description',
            ],
            self::TAB_GLOBAL => [
                'is_website_offline', 'report_email', 'location', 'mapApiKey', 'anotherProjectsUrl'
            ],
            self::TAB_CONTENT => [
                'main_stage', 'main_stage_max_items_count', 'catalog_items_per_page', 'parking_stage', 'storage_stage', 'commercial_stage'
            ],
        ];
    }
}
