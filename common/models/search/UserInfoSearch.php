<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserInfo;
use dektrium\user\models\User;

/**
 * UserInfoSearch represents the model behind the search form about `common\models\UserInfo`.
 */
class UserInfoSearch extends UserInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'team_id', 'created_at', 'updated_at'], 'integer'],
            [['truename', 'phone', 'email', 'user_id', 'qq'], 'filter', 'filter' => 'trim'],
            [['user_id', 'truename', 'phone', 'email', 'qq', 'address', 'avatar', 'memo', 'status', 'birthday'], 'safe'],
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
        $query = UserInfo::find();

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

        // convert unix timestamp
        if (!empty($this->birthday)) {
        	$this->birthday = strtotime($this->birthday);
        }
        
        // join related table
        $query->from(UserInfo::tableName() . ' t')->joinWith([
                'user' => function ($q)
                {
                    $q->from(User::tableName() . ' u');
                } 
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'uid' => $this->uid,
//             'user_id' => $this->user_id,
            'birthday' => $this->birthday,
            'team_id' => $this->team_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);
        
        // default show undelete data
        if ($this->status == null) {
            $query->andFilterWhere(['<>', 'status', (string) \Yii::$app->params['deleted']]);
        }
        
        $query->andFilterWhere(['like', 'truename', $this->truename])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 't.email', $this->email])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'memo', $this->memo])
//             ->andFilterWhere(['like', 'status', $this->status])
       		->andFilterWhere(['like', 'u.username', $this->user_id]);

        return $dataProvider;
    }
}
