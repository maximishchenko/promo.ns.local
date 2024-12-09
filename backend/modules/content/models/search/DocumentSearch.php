<?php

declare(strict_types=1);

namespace backend\modules\content\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\content\models\Document;
use common\models\Sort;
use yii\data\DataProviderInterface;

class DocumentSearch extends Document
{
    public function rules(): array
    {
        return [
            [['id', 'category_id', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['file_name', 'file_extension', 'comment'], 'safe'],
            [['file_size'], 'number'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($id, $params): DataProviderInterface
    {
        $query = Document::find()->where(['category_id' => $id]);

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
            'category_id' => $this->category_id,
            'file_size' => $this->file_size,
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_extension', $this->file_extension])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
