<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FeeInfo;
use common\models\MatchInfo;

/**
 * FeeInfoSearch represents the model behind the search form about `common\models\FeeInfo`.
 */
class FeeInfoSearch extends FeeInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fee_id', 'match_id', 'income', 'expense', 'remain', 'status'], 'integer'],
            [['memo'], 'filter', 'filter'=>'trim'],
            [['fee_id', 'match_id', 'income', 'expense', 'remain', 'status', 'memo', 'created_at'], 'safe'],
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
        $query = FeeInfo::find();
        $subQuery = MatchInfo::find()
            ->select('match_id, hold_time, h.team_name home_team, v.team_name visiters_team')
            ->joinWith(['home h', 'visiters v']);
        $query->from($this->tableName() . ' t')->leftJoin(['m' => $subQuery], 'm.match_id = t.match_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        // Hack start TODO
        $homeTeam = $params['FeeInfoSearch']['match']['home']['team_name'];
        $visitersTeam = $params['FeeInfoSearch']['match']['visiters']['team_name'];
        $hold_time = $params['FeeInfoSearch']['match']['hold_time'];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // convert unix timestamp
        if (!empty($this->created_at)) {
            // Compare UTC+8 time to UTC
            $this->created_at = strtotime($this->created_at) + 8*60*60;
            $nextDay = $this->created_at + 24 * 60 * 60;
        }
        if (!empty($hold_time)) {
            // Compare UTC+8 time to UTC
            $hold_time = strtotime($hold_time) + 8*60*60;
        }
        
        // default to show undeleted data
        if ($this->status == null) {
            $query->andFilterWhere(['<>', 't.status', self::STATUS_DELETED]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'fee_id' => $this->fee_id,
            'match_id' => $this->match_id,
            'income' => $this->income,
            'expense' => $this->expense,
            'remain' => $this->remain,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'm.hold_time' => $hold_time,
        ]);

        $query->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['BETWEEN', 'created_at', $this->created_at, $nextDay])
            ->andFilterWhere(['like', 'home_team', $homeTeam])
            ->andFilterWhere(['like', 'visiters_team', $visitersTeam]);

        return $dataProvider;
    }
}
