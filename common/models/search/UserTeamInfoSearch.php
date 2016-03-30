<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserTeamInfo;

/**
 * UserTeamInfoSearch represents the model behind the search form about `common\models\UserTeamInfo`.
 */
class UserTeamInfoSearch extends UserTeamInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'team_id', 'position_id', 'number', 'status'], 'integer'],
            [['number'], 'filter', 'filter' => 'trim'],
            [['id', 'uid', 'team_id', 'join_time', 'left_time', 'position_id', 'number', 'status'], 'safe'],
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
        $query = UserTeamInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        // Convert into unix time
        if (!empty($this->left_time)) {
            $this->left_time = strtotime($this->left_time);
        }
        if (!empty($this->join_time)) {
            $this->join_time = strtotime($this->join_time);
        }

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
            'id' => $this->id,
            'uid' => $this->uid,
            'team_id' => $this->team_id,
            'join_time' => $this->join_time,
            'left_time' => $this->left_time,
            'position_id' => $this->position_id,
            'number' => $this->number,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
