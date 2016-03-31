<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MatchInfo;

/**
 * MatchInfoSearch represents the model behind the search form about `common\models\MatchInfo`.
 */
class MatchInfoSearch extends MatchInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_id', 'area_id', 'home_id', 'home_score', 'visiters_id', 'visiters_score', 'hold_time', 'status'], 'integer'],
            [['full_time', 'memo'], 'safe'],
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
        $query = MatchInfo::find();

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
        
        // default to show undeleted data
        if ($this->status == null) {
            $query->andFilterWhere(['<>', 'status', self::STATUS_DELETED]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'match_id' => $this->match_id,
            'area_id' => $this->area_id,
            'home_id' => $this->home_id,
            'home_score' => $this->home_score,
            'visiters_id' => $this->visiters_id,
            'visiters_score' => $this->visiters_score,
            'hold_time' => $this->hold_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'full_time', $this->full_time])
            ->andFilterWhere(['like', 'memo', $this->memo]);

        return $dataProvider;
    }
}
