<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\GalleryUploadQuery;
use backend\traits\fileTrait;
use common\models\Sort;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%gallery_upload}}".
 *
 * @property int $id
 * @property int $gallery_id
 * @property string|null $file_name
 * @property int|null $sort
 * @property \yii\web\UploadedFile $sort
 *
 * @property Gallery $gallery
 */
class GalleryUpload extends \yii\db\ActiveRecord
{
    use fileTrait;

    const UPLOAD_PATH = 'upload/gallery/';

    public $file;
    
    public static function tableName(): string
    {
        return '{{%gallery_upload}}';
    }

    public function rules(): array
    {
        return [
            [['gallery_id'], 'required'],
            [['gallery_id', 'sort'], 'integer'],
            
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp, video/*'],
            [['file'], 'safe']
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'gallery_id' => Yii::t('app', 'Gallery ID'),
            'file_name' => Yii::t('app', 'File Name'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }

    public function getGallery(): ActiveQuery
    {
        return $this->hasOne(Gallery::class, ['id' => 'gallery_id']);
    }
    
    public static function find(): GalleryUploadQuery
    {
        return new GalleryUploadQuery(get_called_class());
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile("file", "file_name", self::UPLOAD_PATH, true);
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
