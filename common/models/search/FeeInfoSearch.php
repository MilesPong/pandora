<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FeeInfo;

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
            [['memo'], 'safe'],
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
            'fee_id' => $this->fee_id,
            'match_id' => $this->match_id,
            'income' => $this->income,
            'expense' => $this->expense,
            'remain' => $this->remain,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'memo', $this->memo]);

        return $dataProvider;
    }
}
