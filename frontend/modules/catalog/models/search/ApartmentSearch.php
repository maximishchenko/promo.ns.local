<?php

namespace frontend\modules\catalog\models\search;

use backend\modules\catalog\models\House;
use backend\modules\catalog\models\Layout;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\catalog\models\Apartment;
use Yii;
use yii\data\DataProviderInterface;

class ApartmentSearch extends Apartment
{
    public $countRooms;

    public $totalArea;

    public $minArea;

    public $maxArea;

    public $house;


    public function rules(): array
    {
        return [
            [['id', 'layout_id', 'sort', 'created_at', 'updated_at', 'apartment_floor', 'created_by', 'updated_by'], 'integer'],
            [['image', 'status', 'comment', 'countRooms', 'totalArea', 'minArea', 'maxArea', 'house'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search(array $params): DataProviderInterface
    {
        $query = Apartment::getDb()->cache(function() {
            // return Apartment::find()->joinWith(['house'])->byLayout()->minFloor()->forSale()->active();
            return Apartment::find()->joinWith(['house'])->minFloor()->forSale()->active();
        }, Apartment::getCacheDuration(), Apartment::getCacheDependency());

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->configManager->getItemValue('catalogItemsPerPage'),
            ],
            'sort'=> [
                'defaultOrder' => [
                    'id'=>SORT_DESC
                ]
            ],
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'totalArea' => [
                    'asc' => [Layout::tableName() . '.total_area' => SORT_ASC, Apartment::tableName() . '.extended_total_area' => SORT_ASC],
                    'desc' => [Layout::tableName() . '.total_area' => SORT_DESC, Apartment::tableName() . '.extended_total_area' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ],
            'defaultOrder' => [
                'totalArea'=>SORT_ASC
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            House::tableName() . '.id' => $this->house,
            Layout::tableName() . '.count_rooms' => $this->countRooms,
        ]);

        $query->orFilterWhere([Apartment::tableName() . '.extended_count_rooms' => $this->countRooms]);
        $query->andFilterWhere(['between', Layout::tableName() . '.total_area', $this->minArea, $this->maxArea]);

        return $dataProvider;
    }

    public function formName()
    {
        return '';
    }
}
