<?php

namespace backend\modules\content\models;

use backend\modules\content\models\query\OfferQuery;
use backend\traits\fileTrait;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%offer}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $preview_text
 * @property string|null $description_text
 * @property string|null $preview_image
 * @property string|null $description_image
 * @property string|null $previewImageFile
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Offer extends \yii\db\ActiveRecord
{
    use fileTrait;

    const UPLOAD_PATH = 'upload/offer/';

    public $previewImageFile;
    
    public function behaviors(): array
    {
        return[
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date('U');
                },
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => ['name'],
                'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique'=>true,
            ],
        ];
    }  

    public static function tableName(): string
    {
        return '{{%offer}}';
    }

    public function rules(): array
    {
        return [
            [['preview_text', 'comment'], 'string'],
            [['sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'slug', 'preview_image'], 'string', 'max' => 255],

            [['name', 'preview_text'], 'required'],
            [['name'], 'unique'],
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['previewImageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Offer Name'),
            'slug' => Yii::t('app', 'Slug'),
            'preview_text' => Yii::t('app', 'Offer Preview Text'),
            'preview_image' => Yii::t('app', 'Offer Preview Image'),
            'previewImageFile' => Yii::t('app', 'Offer Preview Image'),
            'comment' => Yii::t('app', 'Comment'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function attributeHints(): array
    {
        return [
            'name' => Yii::t('app', 'Offer Name Hint'),
            'preview_text' => Yii::t('app', 'Offer Preview Hint'),
            'previewImageFile' => Yii::t('app', 'Offer preview imageFile Hint {extensions}', ['extensions' => 'png, jpg, jpeg, webp']),
            'comment' => Yii::t('app', 'Comment Hint'),
            'sort' => Yii::t('app', 'Sort Hint. Default value is {sortDefault}', ['sortDefault' => Sort::DEFAULT_SORT_VALUE]),
            'status' => Yii::t('app', 'Status Hint'),
        ];
    }

    public static function find(): OfferQuery
    {
        return new OfferQuery(get_called_class());
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile('previewImageFile', 'preview_image', self::UPLOAD_PATH);
            return true;
        }
        return false;
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            $this->deleteSingleFile('preview_image', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
