<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%match_info}}".
 *
 * @property integer $match_id
 * @property integer $area_id
 * @property integer $home_id
 * @property integer $home_score
 * @property integer $visiters_id
 * @property integer $visiters_score
 * @property integer $hold_time
 * @property string $full_time
 * @property string $memo
 * @property integer $status
 *
 * @property FeeInfo[] $feeInfos
 * @property JudgeInfo $judgeInfo
 * @property AreaInfo $area
 * @property TeamInfo $home
 * @property TeamInfo $visiters
 * @property MatchUserDetail[] $matchUserDetails
 */
class MatchInfo extends \common\core\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%match_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id', 'home_id', 'home_score', 'visiters_id', 'visiters_score', 'hold_time', 'full_time'], 'required'],
            [['area_id', 'home_id', 'home_score', 'visiters_id', 'visiters_score', 'status'], 'integer'],
            [['memo'], 'string'],
            [['full_time'], 'string', 'max' => 25],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => AreaInfo::className(), 'targetAttribute' => ['area_id' => 'area_id'], 'filter'=>['status'=>AreaInfo::STATUS_ACTIVE]],
            [['home_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeamInfo::className(), 'targetAttribute' => ['home_id' => 'team_id'], 'filter'=>['status'=>TeamInfo::STATUS_ACTIVE]],
            [['visiters_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeamInfo::className(), 'targetAttribute' => ['visiters_id' => 'team_id'], 'filter'=>['status'=>TeamInfo::STATUS_ACTIVE]],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => $this->getStatusArray()],
            ['hold_time', 'date', 'timestampAttribute' => 'hold_time'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'match_id' => Yii::t('app', 'Match ID'),
            'area_id' => Yii::t('app', 'Area ID'),
            'home_id' => Yii::t('app', 'Home ID'),
            'home_score' => Yii::t('app', 'Home Score'),
            'visiters_id' => Yii::t('app', 'Visiters ID'),
            'visiters_score' => Yii::t('app', 'Visiters Score'),
            'hold_time' => Yii::t('app', 'Hold Time'),
            'full_time' => Yii::t('app', 'Full Time'),
            'memo' => Yii::t('app', 'Memo'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeInfos()
    {
        return $this->hasMany(FeeInfo::className(), ['match_id' => 'match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJudgeInfo()
    {
        return $this->hasOne(JudgeInfo::className(), ['match_id' => 'match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(AreaInfo::className(), ['area_id' => 'area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHome()
    {
        return $this->hasOne(TeamInfo::className(), ['team_id' => 'home_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisiters()
    {
        return $this->hasOne(TeamInfo::className(), ['team_id' => 'visiters_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchUserDetails()
    {
        return $this->hasMany(MatchUserDetail::className(), ['match_id' => 'match_id']);
    }
}
