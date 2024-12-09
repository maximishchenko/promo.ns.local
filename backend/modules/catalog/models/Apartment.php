<?php

declare(strict_types=1);

namespace backend\modules\catalog\models;

use backend\modules\catalog\models\query\ApartmentQuery;
use backend\traits\fileTrait;
use common\models\ApartmentStatus;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%apartment}}".
 *
 * @property int $id
 * @property int $layout_id
 * @property int $number
 * @property int $apartment_floor
 * @property float $price
 * @property int $discount
 * @property string|null $image
 * @property string|null $status
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property-read \yii\db\ActiveQuery $house
 * @property-read \yii\db\ActiveQuery $entrance
 * @property-read array $layoutItems
 * @property-read array $floors
 * @property-read string $apartmentName
 * @property Layout $layout
 * @property string $slug [varchar(255)]
 */
class Apartment extends \yii\db\ActiveRecord
{
    use fileTrait;

    const UPLOAD_PATH = 'upload/apartment/';

    public $imageFile;

    public $layoutImageFile;
    
    public static function tableName(): string
    {
        return '{{%apartment}}';
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
            [
                'class' => SluggableBehavior::className(),
                'attribute' => ['apartmentName'],
                'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique'=>true,
            ],
        ];
    }  

    public function rules(): array
    {
        return [
            [['layout_id', 'sort', 'created_at', 'updated_at', 'created_by', 'updated_by', 'number', 'apartment_floor'], 'integer'],
            [['comment'], 'string'],
            [['price', 'discount', 'extended_total_area', 'extended_count_rooms'], 'number'],
            ['price', 'default', 'value' => 0],
            ['discount', 'default', 'value' => 0],
            ['discount', 'in', 'range' => [0, 100]],
            [['image', 'extended_layout_image'], 'string', 'max' => 255],
            [['layout_id'], 'exist', 'skipOnError' => true, 'targetClass' => Layout::class, 'targetAttribute' => ['layout_id' => 'id']],
            
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            ['sale_status', 'in', 'range' => array_keys(ApartmentStatus::getStatusesArray())],
            [['apartment_floor', 'layout_id', 'status'], 'required'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'entrance' => Yii::t('app', 'Entrance Name'),
            'house' => Yii::t('app', 'Apartment House'),
            'apartmentName' => Yii::t('app', 'Apartment Name'),
            'layout_id' => Yii::t('app', 'Layout ID'),
            'apartment_floor' => Yii::t('app', 'Apartment Floor'),
            'number' => Yii::t('app', 'Apartment Number'),
            'extended_total_area' => Yii::t('app', 'Extended Total Area'),
            'extended_count_rooms' => Yii::t('app', 'Extended Count Rooms'),
            'price' => Yii::t('app', 'Price'),
            'discount' => Yii::t('app', 'Discount'),
            'slug' => Yii::t('app', 'Slug'),
            'image' => Yii::t('app', 'Image'),
            'imageFile' => Yii::t('app', 'Apartment Image'),
            'extended_layout_image' => Yii::t('app', 'Extended Layout Image'),
            'layoutImageFile' => Yii::t('app', 'Extended Layout Image File'),
            'status' => Yii::t('app', 'Status'),
            'sale_status' => Yii::t('app', 'Sale Status'),
            'comment' => Yii::t('app', 'Comment'),
            'sort' => Yii::t('app', 'Sort'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function attributeHints(): array
    {
        return [
            'price' => Yii::t('app', 'Price Hint'),
            'discount' => Yii::t('app', 'Discount Hint'),
            'extended_total_area' => Yii::t('app', 'Extended Total Area Hint'),
            'extended_count_rooms' => Yii::t('app', 'Extended Count Rooms Hint'),
            'layoutImageFile' => Yii::t('app', 'Extended Layout Image File Hint')
        ];
    }

    public function getLayout(): ActiveQuery
    {
        return $this->hasOne(Layout::class, ['id' => 'layout_id']);
    }

    public function getLayoutItems(): array
    {
        $layouts = Layout::find()->all();
        return ArrayHelper::map($layouts,'id','nameWithHouseAndSection');
    }

    public function getFloors(): array
    {
        $floors = [];
        if (!$this->isNewRecord):
            $entrance = Entrance::find()->where(['id' => $this->layout->entrance_id])->one();
            if ($entrance) {
                $firstFloor = $entrance->getFirstFloorNumber();
                for ($floor = $firstFloor; $floor <= $entrance->count_floors; $floor++) {
                    $floors[$floor] = $floor;
                }
            }
        endif;

        return $floors;
    }

    public function getApartmentName(): string
    {
        // $count_rooms = ($this->extended_count_rooms) ? $this->extended_count_rooms : null;
        // $total_area = ($this->extended_total_area) ? $this->extended_total_area : null;

        return ($this->extended_count_rooms || $this->extended_total_area) ? 'Кв. № ' . $this->number . ' (' . $this->nameWithCountRoomsAndTotalArea . ')' : 'Кв. № ' . $this->number . ' (' . $this->layout->nameWithCountRoomsAndTotalArea . ')';
    }

    

    public function getNameWithCountRoomsAndTotalArea(): string
    {
        return Yii::t('app', '{count_rooms} - suffix {total_area}', ['count_rooms' => $this->extended_count_rooms, 'total_area' => $this->extended_total_area]);
    }

    public function getEntrance(): ActiveQuery
    {
        return $this->hasOne(Entrance::class, ['id' => 'entrance_id'])->viaTable(Layout::tableName(), ['id' => 'layout_id']);
    }

    public function getHouse(): ActiveQuery
    {
        return $this->hasOne(House::class, ['id' => 'house_id'])->via('entrance');
    }

    public static function find(): ApartmentQuery
    {
        return new ApartmentQuery(get_called_class());
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile('imageFile', 'image', self::UPLOAD_PATH);
            $this->uploadFile('layoutImageFile', 'extended_layout_image', self::UPLOAD_PATH);
            return true;
        }
        return false;
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            $this->deleteSingleFile('image', self::UPLOAD_PATH);
            $this->deleteSingleFile('extended_layout_image', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
