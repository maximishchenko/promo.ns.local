<?php
declare(strict_types=1);

namespace backend\modules\catalog\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\catalog\models\Apartment;
use backend\modules\catalog\models\Entrance;
use backend\modules\catalog\models\House;
use common\models\Sort;
use yii\data\DataProviderInterface;

class ApartmentSearch extends Apartment
{

    public $house;

    public $entrance;
    
    public function rules(): array
    {
        return [
            [['id', 'layout_id', 'sort', 'created_at', 'updated_at', 'apartment_floor', 'created_by', 'updated_by'], 'integer'],
            [['image', 'status', 'sale_status', 'comment', 'entrance', 'house'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params): DataProviderInterface
    {
        $query = Apartment::find()->joinWith(['entrance', 'house']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => Sort::getBackendDefaultSort()],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                // 'name',
                'layout_id',
                'apartment_floor',
                'sort',
                'status',
                'sale_status',
                'entrance' => [
                    'asc' => [Entrance::tableName() . '.number' => SORT_ASC],
                    'desc' => [Entrance::tableName() . '.number' => SORT_DESC],
                ],
                'house' => [
                   'asc' => [House::tableName() . '.name' => SORT_ASC],
                   'desc' => [House::tableName() . '.name' => SORT_DESC],
                ]
           ]
       ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'apartment_floor' => $this->apartment_floor,
            'layout_id' => $this->layout_id,
            'sort' => $this->sort,
            'status' => $this->status,
            'sale_status' => $this->sale_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            Entrance::tableName() . '.id' => $this->entrance,
        ]);

        return $dataProvider;
    }
}
