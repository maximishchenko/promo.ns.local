<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\DocumentQuery;
use backend\traits\fileTrait;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property int $id
 * @property string|null $name
 * @property int $category_id
 * @property string|null $file_name
 * @property string|null $file_extension
 * @property float|null $file_size
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property-read \yii\db\ActiveQuery $category
 * @property DocumentCategory $documentCategory
 */
class Document extends \yii\db\ActiveRecord
{
    use fileTrait;

    const UPLOAD_PATH = 'upload/document/';

    public $file;

    public static function tableName(): string
    {
        return '{{%document}}';
    }

    public function rules(): array
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['file_size'], 'number'],
            [['comment'], 'string'],
            [['file_name', 'file_extension'], 'string', 'max' => 255],
            
            [['name'], 'unique'],
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Document Name'),
            'category_id' => Yii::t('app', 'Category ID'),
            'file_name' => Yii::t('app', 'Document File Name'),
            'file' => Yii::t('app', 'Document File'),
            'file_extension' => Yii::t('app', 'Document File Extension'),
            'file_size' => Yii::t('app', 'Document File Size'),
            'comment' => Yii::t('app', 'Comment'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(DocumentCategory::class, ['id' => 'category_id']);
    }

    public static function find(): DocumentQuery
    {
        return new DocumentQuery(get_called_class());
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile('file', 'file_name', self::UPLOAD_PATH);
            $this->setFileExtensionAttribute('file', 'file_extension');
            $this->setFileSizeAttribute('file', 'file_size');
            return true;
        }
        return false;
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            $this->deleteSingleFile('file_name', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
