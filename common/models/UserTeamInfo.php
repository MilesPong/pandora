<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_team_info}}".
 *
 * @property integer $id 
 * @property integer $uid
 * @property integer $team_id
 * @property integer $join_time
 * @property integer $left_time
 * @property integer $position_id
 * @property integer $number
 * @property integer $status
 * 
 * @property PositionInfo $position 
 * @property TeamInfo $team 
 * @property UserInfo $u 
 */
class UserTeamInfo extends \common\core\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_team_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'team_id', 'join_time', 'position_id', 'number'], 'required'],
            [['uid', 'team_id', 'position_id', 'number', 'status'], 'integer'],
            ['join_time', 'date', 'timestampAttribute'=>'join_time'],
            ['left_time', 'date', 'timestampAttribute'=>'left_time'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => $this->getStatusArray()],
            
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => PositionInfo::className(), 'targetAttribute' => ['position_id' => 'position_id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeamInfo::className(), 'targetAttribute' => ['team_id' => 'team_id'], 'filter'=>['status'=>TeamInfo::STATUS_ACTIVE]],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => UserInfo::className(), 'targetAttribute' => ['uid' => 'uid'], 'filter'=>['status'=>UserInfo::STATUS_ACTIVE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
            'team_id' => Yii::t('app', 'Team ID'),
            'join_time' => Yii::t('app', 'Join Time'),
            'left_time' => Yii::t('app', 'Left Time'),
            'position_id' => Yii::t('app', 'Position ID'),
            'number' => Yii::t('app', 'Number'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(PositionInfo::className(), ['position_id' => 'position_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(TeamInfo::className(), ['team_id' => 'team_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(UserInfo::className(), ['uid' => 'uid']);
    }
}
