<?php

declare(strict_types=1);

namespace backend\modules\content\models\search;

use common\components\StagePosition;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\content\models\StageItem;
use common\models\Sort;
use yii\data\DataProviderInterface;

class StageItemSearch extends StageItem
{
    public function rules(): array
    {
        return [
            [['id', 'stage_id', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'comment', 'position'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search(int $id, array $params): DataProviderInterface
    {
        $query = StageItem::find()->where(['stage_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'id' => Sort::getBackendDefaultSort()
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'stage_id' => $this->stage_id,
            'sort' => $this->sort,
            'status' => $this->status,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
