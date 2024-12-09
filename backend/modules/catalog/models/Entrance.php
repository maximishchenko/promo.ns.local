<?php

declare(strict_types=1);

namespace backend\modules\catalog\models;

use backend\modules\catalog\models\query\EntranceQuery;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%entrance}}".
 *
 * @property int $id
 * @property int|null $house_id
 * @property string|null $number
 * @property int|null $count_floors
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property House $house
 * @property Layout[] $layouts
 */
class Entrance extends \yii\db\ActiveRecord
{

    const NAME_PREFIX = 'Подъезд ';

    public static function tableName(): string
    {
        return '{{%entrance}}';
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
            [['house_id', 'count_floors', 'number', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'has_commercial_floor'], 'integer'],
            [['comment'], 'string'],
            [['house_id'], 'exist', 'skipOnError' => true, 'targetClass' => House::class, 'targetAttribute' => ['house_id' => 'id']],
            
            ['sort', 'default', 'value' => Sort::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],

            [['number', 'count_floors', 'house_id'], 'required'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'house_id' => Yii::t('app', 'Entrance House ID'),
            'number' => Yii::t('app', 'Entrance Number'),
            'count_floors' => Yii::t('app', 'Count Foors'),
            'has_commercial_floor' => Yii::t('app', 'Entrance has commercial floor'),
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
            'number' => Yii::t('app', 'Entrance Number Hint'),
            'house_id' => Yii::t('app', 'Entrance House ID Hint'),
            'has_commercial_floor' => Yii::t('app', 'Has Entrance Commercial Floor'),
            'count_floors' => Yii::t('app', 'Entrance Count Floors Hint'),
            'comment' => Yii::t('app', 'Comment Hint'),
            'sort' => Yii::t('app', 'Sort Hint. Default value is {sortDefault}', ['sortDefault' => Sort::DEFAULT_SORT_VALUE]),
            'status' => Yii::t('app', 'Status Hint'),
        ];
    }

    public function getHouse(): ActiveQuery
    {
        return $this->hasOne(House::class, ['id' => 'house_id']);
    }

    public function getLayouts(): ActiveQuery
    {
        return $this->hasMany(Layout::class, ['entrance_id' => 'id']);
    }

    public static function find(): EntranceQuery
    {
        return new EntranceQuery(get_called_class());
    }

    public function getHousesItems(): array
    {
        $houses = House::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($houses,'id','nameWithPrefix');
    }

    public function getNumberWithPrefix(): string
    {
        return self::NAME_PREFIX . " " . $this->number;
    }

    public function getNumberWithHouseAndPrefix(): string
    {
        return $this->house->nameWithPrefix . ', ' . self::NAME_PREFIX . ' ' . $this->number;
    }

    public function getFirstFloorNumber(): int
    {
        return ($this->has_commercial_floor) ? 2 : 1;
    }
}
