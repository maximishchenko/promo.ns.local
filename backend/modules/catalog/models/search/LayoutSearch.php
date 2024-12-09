<?php
declare(strict_types=1);

namespace backend\modules\catalog\models\search;

use backend\modules\catalog\models\Entrance;
use backend\modules\catalog\models\House;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\catalog\models\Layout;
use common\models\Sort;
use yii\data\DataProviderInterface;

class LayoutSearch extends Layout
{

    public $house;

    public $entrance;

    public function rules(): array
    {
        return [
            [['id', 'entrance_id', 'count_rooms', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['image', 'comment', 'house', 'entrance'], 'safe'],
            [['total_area'], 'number'],
        ];
    }
    
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params): DataProviderInterface
    {
        $query = Layout::find();
        $query->with(['entrance']);
        $query->joinWith(['house']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>Sort::getBackendDefaultSort()]],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                // 'name',
                'count_rooms',
                'total_area',
                'sort',
                'status',
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
            'entrance_id' => $this->entrance_id,
            'count_rooms' => $this->count_rooms,
            'total_area' => $this->total_area,
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            House::tableName() . '.id' => $this->house,
            Entrance::tableName() . '.id' => $this->entrance,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
