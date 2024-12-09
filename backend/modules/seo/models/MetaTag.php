<?php
declare(strict_types=1);

namespace backend\modules\seo\models;

use backend\modules\seo\models\query\MetaTagQuery;
use common\models\Status;
use common\models\Sort;
use Yii;


class MetaTag extends \yii\db\ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%meta_tag}}';
    }

    public function rules(): array
    {
        return [
            [['meta_description', 'og_description', 'og_image', 'description_text'], 'string'],
            [['sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['url', 'meta_title', 'meta_keywords', 'og_title', 'og_url', 'og_sitename', 'og_type', 'h1_text'], 'string', 'max' => 255],
            [['url'], 'unique'],

            [['url', 'meta_title'], 'required'],
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'h1_text' => Yii::t('app', 'h1 Header text'),
            'description_text' => Yii::t('app', 'Description Snippet Text'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'og_title' => Yii::t('app', 'Og Title'),
            'og_description' => Yii::t('app', 'Og Description'),
            'og_image' => Yii::t('app', 'Og Image'),
            'og_url' => Yii::t('app', 'Og Url'),
            'og_sitename' => Yii::t('app', 'Og Sitename'),
            'og_type' => Yii::t('app', 'Og Type'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public static function find(): MetaTagQuery
    {
        return new MetaTagQuery(get_called_class());
    } 
}
