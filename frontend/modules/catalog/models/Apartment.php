<?php

namespace frontend\modules\catalog\models;

use backend\modules\catalog\models\Apartment as backendApartment;
use backend\modules\catalog\models\Entrance;
use frontend\modules\catalog\models\House;
use common\models\ApartmentStatus;
use frontend\modules\catalog\models\Layout;
use frontend\modules\catalog\models\query\LayoutQuery;
use common\models\Status;
use frontend\modules\catalog\models\query\ApartmentQuery;
use frontend\traits\cacheParamsTrait;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%apartment}}".
 *
 * @property int $id
 * @property int $layout_id
 * @property int $apartment_floor
 * @property string|null $image
 * @property string|null $status
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property-read \frontend\modules\catalog\models\query\LayoutQuery $totalArea
 * @property-read int $minTotalArea
 * @property-read \yii\db\ActiveQuery $entrance
 * @property-read array $houses
 * @property-read int $maxTotalArea
 * @property-read null|string $maxRoomsCount
 * @property-read string $houseNameById
 * @property-read \frontend\modules\catalog\models\House|null $activeHouses
 * @property-read \yii\db\ActiveQuery $house
 * @property-read array $apartmentroomsCount
 * @property-read string $thumb
 * @property-read \frontend\modules\catalog\models\query\LayoutQuery $rooms
 * @property-read null|string $minRoomsCount
 * @property Layout $layout
 * @property string $slug [varchar(255)]
 */
class Apartment extends backendApartment
{
    use cacheParamsTrait;

    const NO_IMAGE = '/static/sprite.svg#noimage';
    
    public static function find(): ApartmentQuery
    {
        return new ApartmentQuery(get_called_class());
    }

    public function getMinRoomsCount(): ?string
    {
        return $this->getRooms()->minRooms();
    }

    public function getMaxRoomsCount(): ?string
    {
        return $this->getRooms()->maxRooms();
    }

    public function getLayout(): ActiveQuery
    {
        return $this->hasOne(Layout::class, ['id' => 'layout_id']);
    }

    public function getMinTotalArea(): int
    {
        return round($this->getTotalArea()->min('total_area'), 0, PHP_ROUND_HALF_DOWN);
    }

    public function getMaxTotalArea(): int
    {
        return round($this->getTotalArea()->max('total_area'), 0, PHP_ROUND_HALF_UP);
    }

    public static function getMinArea(): ?float
    {
        $params = Yii::$app->request->queryParams;
        return (!empty($params['minArea'])) ? $params['minArea'] : null;
    }

    public static function getMaxArea(): ?float
    {
        $params = Yii::$app->request->queryParams;
        return (!empty($params['maxArea'])) ? $params['maxArea'] : null;
    }

    public function getHouses(): array
    {
        return House::getDb()->cache(function() {
            return House::find()->where(['status' => Status::STATUS_ACTIVE])->all();
        }, House::getCacheDuration(), House::getCacheDependency());
    }

    public function getHouseNameById(): string
    {
        $house = null;
        $queryParams = Yii::$app->request->queryParams;
        if (!empty($queryParams['house'])) {
            $house = House::find()->where(['id' => $queryParams['house']])->one();
        }
        if ($house !== null) {
            return 'Литер ' . $house->name;
        }
        return 'Выберите литер';
    }

    public function isCountRoomsChecked(?int $countRooms): ?string
    {
        $queryParams = Yii::$app->request->queryParams;
        if (!empty($queryParams['countRooms']) && $queryParams['countRooms'] == $countRooms) {
            return 'checked';
        }
        return null;
    }

    public function getApartmentPreview(): string
    {
        if (isset($this->extended_layout_image) && !empty($this->extended_layout_image)) {
            return '/' . static::UPLOAD_PATH . $this->extended_layout_image;
        } elseif (isset($this->layout->image) && !empty($this->layout->image)) {
            return '/' . Layout::UPLOAD_PATH . $this->layout->image;
        } else {
            return static::NO_IMAGE;
        }
    }

    public function getThumb(): string
    {
        if (!empty($this->image)) {
            return '/' . static::UPLOAD_PATH . $this->image;
        } elseif (isset($this->layout->image) && !empty($this->layout->image)) {
            return '/' . Layout::UPLOAD_PATH . $this->layout->image;
        } else {
            return static::NO_IMAGE;
        }
    }
    
    public function getExtendedLayoutThumb(): ?string
    {
        if (!empty($this->extended_layout_image)) {
            return '/' . static::UPLOAD_PATH . $this->extended_layout_image;
        } 
        return null;
    }

    public function getEntrance(): ActiveQuery
    {
        return $this->hasOne(Entrance::class, ['id' => 'entrance_id'])->viaTable(Layout::tableName(), ['id' => 'layout_id']);
    }

    public function getHouse(): ActiveQuery
    {
        return $this->hasOne(House::class, ['id' => 'house_id'])->via('entrance');
    }

    public function getApartmentsByFloorAndLayout(int $floor, int $layout_id): Apartment | null
    {
        return self::getDb()->cache(function() use ($floor, $layout_id) {
            return self::find()->active()->where(['apartment_floor' => $floor, 'layout_id' => $layout_id])->one();
        }, self::getCacheDuration(), self::getCacheDependency());
    }

    public function getFirstApartmentByCountRooms(int $count_rooms): Apartment | array | null
    {
        return self::getDb()->cache(function() use ($count_rooms) {
            return self::find()
                ->joinWith(['layout'])
                ->andWhere([
                    Apartment::tableName().'.status' => Status::STATUS_ACTIVE,
                    'sale_status' => [ApartmentStatus::STATUS_FREE, ApartmentStatus::STATUS_RESERVED],
                ])
                ->andWhere([
                    'and',
                    [Layout::tableName() . '.count_rooms' => $count_rooms],
                    [Apartment::tableName() . '.extended_count_rooms' => null],
                ])
                ->orWhere(
                    [Apartment::tableName() . '.extended_count_rooms' => $count_rooms],
                )
                ->orderBy([
                    'apartment_floor' => SORT_ASC
                ])
                ->groupBy([Layout::tableName() . '.total_area', Apartment::tableName() . '.extended_total_area'])
                ->all();
        }, self::getCacheDuration(), self::getCacheDependency());   
    }

    public function getActiveHouses()
    {
        return House::find()->active()->orderBy(['id' => SORT_ASC])->all();
        return House::getDb()->cache(function () {
            return House::find()->active()->orderBy(['id' => SORT_ASC])->all();
        }, House::getCacheDuration(), House::getCacheDependency());
    }

    public function getTotalPrice(): float
    {
        return $this->getFullPrice();
    }

    public function getDiscount(): int
    {
        return $this->getDiscountValue();
    }

    public function getOldPrice(): float
    {
        $discount = $this->getDiscount();
        $totalPrice = $this->getFullPrice();
        return $totalPrice + ($totalPrice * $discount / 100);
    }

    public function getCostPerSquareMater(): float
    {
        return $this->getPriceValue();
    }

    protected function getFullPrice(): float
    {
        $price = $this->getPriceValue();
        // $area = $this->layout->total_area;
        $area = $this->getAreaValue();
        $totalPrice = $price * $area;
        return $totalPrice;
    }

    protected function getDiscountValue(): int
    {
        return ($this->discount) ? $this->discount : $this->layout->discount;
    }

    protected function getPriceValue(): float
    {
        return ($this->price > 0) ? $this->price : $this->layout->price;
    }

    protected function getAreaValue()
    {
        return ($this->extended_total_area) ? $this->extended_total_area : $this->layout->total_area;
    }

    protected function getRooms(): LayoutQuery
    {
        return Layout::getDb()->cache(function() {
            return Layout::find()->select(['count_rooms'])->where(['status' => Status::STATUS_ACTIVE]);
        }, Layout::getCacheDuration(), Layout::getCacheDependency());
    }

    protected function getTotalArea(): LayoutQuery
    {
        return Layout::getDb()->cache(function() {
            return Layout::find()->select(['total_area'])->where(['status' => Status::STATUS_ACTIVE]);
        }, Layout::getCacheDuration(), Layout::getCacheDependency());
    }
}
