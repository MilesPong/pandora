<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%team_info}}".
 *
 * @property integer $team_id
 * @property string $team_name
 * @property integer $captain_id
 * @property string $manager
 * @property integer $rank
 * @property string $memo
 * @property string $status
 *
 * @property MatchInfo[] $matchInfos
 * @property MatchInfo[] $matchInfos0
 * @property UserInfo $captain
 * @property UserInfo[] $userInfos
 * @property UserTeamInfo[] $userTeamInfos
 */
class TeamInfo extends \common\core\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%team_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_name', 'manager'], 'required'],
            [['captain_id', 'rank'], 'integer'],
            [['memo', 'status'], 'string'],
            [['team_name', 'manager'], 'string', 'max' => 25],
//             [['captain_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserInfo::className(), 'targetAttribute' => ['captain_id' => 'uid']],
            ['captain_id', 'in', 'range' => UserInfo::find()->select('uid')->where(['status' => UserInfo::STATUS_ACTIVE])->asArray()->column()],
            [['rank', 'status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['team_name', 'manager'], 'filter' , 'filter' => 'trim'],
            [['team_name', 'captain_id'], 'unique'],
            [['status'], 'in', 'range' => $this->StatusArray],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'team_id' => Yii::t('app', 'Team ID'),
            'team_name' => Yii::t('app', 'Team Name'),
            'captain_id' => Yii::t('app', 'Captain'),
            'manager' => Yii::t('app', 'Manager'),
            'rank' => Yii::t('app', 'Rank'),
            'memo' => Yii::t('app', 'Memo'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchInfos()
    {
        return $this->hasMany(MatchInfo::className(), ['home_id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchInfos0()
    {
        return $this->hasMany(MatchInfo::className(), ['visiters_id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaptain()
    {
        return $this->hasOne(UserInfo::className(), ['uid' => 'captain_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfos()
    {
        return $this->hasMany(UserInfo::className(), ['team_id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTeamInfos()
    {
        return $this->hasMany(UserTeamInfo::className(), ['team_id' => 'team_id']);
    }
    
}
