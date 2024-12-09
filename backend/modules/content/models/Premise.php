<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\PremiseQuery;
use backend\traits\fileTrait;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%premise}}".
 *
 * @property int $id
 * @property string|null $premise_type
 * @property string $name
 * @property string|null $image
 * @property string|null $layout_image
 * @property string|null $description
 * @property string|null $callback_button_name
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property PremiseAdvantage[] $premiseAdvantages
 */
class Premise extends \yii\db\ActiveRecord
{

    use fileTrait;

    const UPLOAD_PATH = 'upload/premise/';

    const SETTINGS_TYPE_PARKING = 'contentParkingStage';

    const SETTINGS_TYPE_STORAGE = 'contentStorageStage';

    const SETTINGS_TYPE_COMMERCIAL = 'contentCommercialStage';

    public $imageFile;

    public $layoutImageFile;
    
    public static function tableName(): string
    {
        return '{{%premise}}';
    }

    public static function instantiate($row): Premise
    {
        switch ($row['premise_type']) {
            case Parking::TYPE:
                return new Parking();
            case Commercial::TYPE:
                return new Commercial();
            case Storage::TYPE:
                return new Storage();
            default:
            return new self;
        }
    }

    public static function getSettingsNamesArray(): array
    {
        return [
            Parking::TYPE => self::SETTINGS_TYPE_PARKING,
            Storage::TYPE => self::SETTINGS_TYPE_STORAGE,
            Commercial::TYPE => self::SETTINGS_TYPE_COMMERCIAL
        ];
    }

    public static function getTitleByPremiseType(): array
    {
        return [
            Parking::TYPE => Yii::t('app', 'Parking'),
            Storage::TYPE => Yii::t('app', 'Storage'),
            Commercial::TYPE => Yii::t('app', 'Commercial'),
        ];
    }
    
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
        ];
    }  

    public function rules(): array
    {
        return [
            [['description', 'comment'], 'string'],
            [['sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['premise_type', 'name', 'image', 'layout_image', 'callback_button_name'], 'string', 'max' => 255],
            
            [['name'], 'required'],
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
            [['layoutImageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp, svg'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Parking Image'),
            'layout_image' => Yii::t('app', 'Parking Layout Image'),
            'imageFile' => Yii::t('app', 'Parking Image'),
            'layoutImageFile' => Yii::t('app', 'Layout Image'),
            'description' => Yii::t('app', 'Parking Description'),
            'callback_button_name' => Yii::t('app', 'Callback Button Name'),
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
            
            'name' => Yii::t('app', 'Parking Name Hint'),
            'imageFile' => Yii::t('app', 'Parking imageFile Hint {extensions}', ['extensions' => 'png, jpg, jpeg, webp']),
            'layoutImageFile' => Yii::t('app', 'Parking layoutImageFile Hint {extensions}', ['extensions' => 'png, jpg, jpeg, webp']),
            'description' => Yii::t('app', 'Parking Description Hint'),
            'callback_button_name' => Yii::t('app', 'Parking Callback Button Name Hint'),
            'comment' => Yii::t('app', 'Parking Comment Hint'),
            'sort' => Yii::t('app', 'Sort Hint. Default value is {sortDefault}', ['sortDefault' => Sort::DEFAULT_SORT_VALUE]),
            'status' => Yii::t('app', 'Status Hint'),
        ];
    }

    public function getPremiseAdvantages(): ActiveQuery
    {
        return $this->hasMany(PremiseAdvantage::class, ['premise_id' => 'id']);
    }

    public static function find(): PremiseQuery
    {
        return new PremiseQuery(get_called_class());
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile('imageFile', 'image', self::UPLOAD_PATH);
            $this->uploadFile('layoutImageFile', 'layout_image', self::UPLOAD_PATH);
            return true;
        }
        return false;
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            $this->deleteSingleFile('image', self::UPLOAD_PATH);
            $this->deleteSingleFile('layout_image', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
