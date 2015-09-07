<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AreaInfo;

/**
 * AreaInfoSearch represents the model behind the search form about `common\models\AreaInfo`.
 */
class AreaInfoSearch extends AreaInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id'], 'integer'],
            [['area_name', 'position_lng', 'position_lat', 'memo', 'status'], 'safe'],
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
        $query = AreaInfo::find();

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
            'area_id' => $this->area_id,
        ]);

        $query->andFilterWhere(['like', 'area_name', $this->area_name])
            ->andFilterWhere(['like', 'position_lng', $this->position_lng])
            ->andFilterWhere(['like', 'position_lat', $this->position_lat])
            ->andFilterWhere(['like', 'memo', $this->memo])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
