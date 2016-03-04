<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TeamInfo;
use common\models\UserInfo;

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
            [['team_id', 'rank'], 'integer'],
            [['team_name', 'manager', 'captain_id'], 'filter' , 'filter' => 'trim'],
            [['team_name', 'captain_id', 'manager', 'memo', 'status'], 'safe'],
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
            $query->where('0=1');
            return $dataProvider;
        }

        // join user_info table
        $query->from(self::tableName() . ' t')->joinWith([
            'captain' => function ($q) {
                    $q->from(UserInfo::tableName() . ' u');
                }
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            't.team_id' => $this->team_id,
//             'captain_id' => $this->captain_id,
            'rank' => $this->rank,
            't.status' => $this->status,
        ]);
        
        // default to show undeleted data
        if ($this->status == null) {
            $query->andFilterWhere(['<>', 't.status', self::STATUS_DELETED]);
        }

        $query->andFilterWhere(['like', 'team_name', $this->team_name])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'u.truename', $this->captain_id]);
//             ->andFilterWhere(['like', 't.status', $this->status]);

        return $dataProvider;
    }
}
