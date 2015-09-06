<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TeamInfo;

/**
 * TeamInfoSearch represents the model behind the search form about `common\models\TeamInfo`.
 */
class TeamInfoSearch extends TeamInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_id', 'captain_id', 'rank'], 'integer'],
            [['team_name', 'manager', 'memo', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = TeamInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'team_id' => $this->team_id,
            'captain_id' => $this->captain_id,
            'rank' => $this->rank,
        ]);

        $query->andFilterWhere(['like', 'team_name', $this->team_name])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
