<?php

namespace backend\modules\management\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\management\models\User;
use common\models\Sort;
use Yii;

/**
 * UserSearch represents the model behind the search form of `backend\modules\management\models\User`.
 */
class UserSearch extends User
{
    public $fullName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'name', 'surname', 'role'], 'safe'],
            [['fullName'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'id' => Sort::getBackendDefaultSort()
                ]
            ],
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'fullName' => [
                    'asc' => ['name' => SORT_ASC, 'surname' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC, 'surname' => SORT_DESC],
                    'label' => Yii::t('app', 'Full Name'),
                    'default' => SORT_ASC
                ],
                'username',
                'status',
                'email',
            ],
            'defaultOrder' => ['id'=>Sort::getBackendDefaultSort()]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname]);

        
        $query->andWhere('name LIKE "%' . $this->fullName . '%" OR surname LIKE "%' . $this->fullName . '%" OR username LIKE "%' . $this->fullName . '%"'
        );

        return $dataProvider;
    }
}
