<?php
declare(strict_types=1);

namespace backend\modules\seo\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\seo\models\Redirect;
use common\models\Sort;
use yii\data\DataProviderInterface;

class RedirectSearch extends Redirect
{
    public function rules(): array
    {
        return [
            [['id', 'redirect_code', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['source_url', 'destination_url', 'comment'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params): DataProviderInterface
    {
        $query = Redirect::find();

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
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'redirect_code' => $this->redirect_code,
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'source_url', $this->source_url])
            ->andFilterWhere(['like', 'destination_url', $this->destination_url])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
