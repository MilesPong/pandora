<?php

namespace common\models;

use Yii;
use dektrium\user\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user_info}}".
 *
 * @property integer $uid
 * @property integer $user_id
 * @property string $truename
 * @property integer $birthday
 * @property string $phone
 * @property string $email
 * @property string $qq
 * @property string $address
 * @property integer $team_id
 * @property string $gravtar
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $memo
 * @property string $status
 *
 * @property MatchUserDetail[] $matchUserDetails
 * @property TeamInfo[] $teamInfos
 * @property TeamInfo $team
 * @property User $user
 */
class UserInfo extends \common\core\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'team_id', 'created_at', 'updated_at'], 'integer'],
            [['truename'], 'required'],
            [['memo', 'status'], 'string'],
            [['truename'], 'string', 'max' => 25],
            [['phone'], 'string', 'max' => 32],
            [['email', 'address', 'gravtar'], 'string', 'max' => 255],
            [['qq'], 'string', 'max' => 15],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeamInfo::className(), 'targetAttribute' => ['team_id' => 'team_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        	['status', 'default', 'value' => 1],
        	[['phone'], 'match' , 'pattern' =>'/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/',
        		'message' => Yii::t('app', 'Your phone number is invalid.')],
        	[['phone'], 'unique' , 'message' => Yii::t('app', 'Your phone number has been used.')],
        	[['phone', 'truename', 'email', 'qq', 'address', 'gravtar'], 'filter' , 'filter' => 'trim'],
        	['birthday', 'date', 'timestampAttribute' => 'birthday'],
        	'emailPattern' => ['email', 'email'],
        	'emailLength' => ['email', 'string', 'max' => 255],
        	'emailUnique' => ['email', 'unique'],
        	[['phone', 'truename', 'email', 'qq', 'address', 'gravtar'], 'filter' , 'filter' => 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('app', 'Uid'),
            'user_id' => Yii::t('app', 'Login User'),
            'truename' => Yii::t('app', 'Truename'),
            'birthday' => Yii::t('app', 'Birthday'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'qq' => Yii::t('app', 'QQ'),
            'address' => Yii::t('app', 'Address'),
            'team_id' => Yii::t('app', 'Team'),
            'gravtar' => Yii::t('app', 'Gravtar'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'memo' => Yii::t('app', 'Memo'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchUserDetails()
    {
        return $this->hasMany(MatchUserDetail::className(), ['uid' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamInfos()
    {
        return $this->hasMany(TeamInfo::className(), ['captain_id' => 'uid']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * Get relative table data [User]
     * @return multitype:
     */
    public function getUserList() {
    	$models = User::find()->asArray()->all();
    	return ArrayHelper::map($models, 'id', 'username');
    }
    
    /**
     * Get relative table data [TeamInfo]
     * @return multitype:
     */
    public function getTeamInfoList() {
    	$models = TeamInfo::find()->asArray()->all();
    	return ArrayHelper::map($models, 'team_id', 'team_name');
    }
    
    public function behaviors()
    {
    	return [
    			[
    					'class' => TimestampBehavior::className(),
    					'attributes' => [
    							ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
    							ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
    					],
    			],
    	];
    }
    
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
    	if (parent::beforeSave($insert)) {
    		// Place your custom code here
    
    		return true;
    	} else {
    		return false;
    	}
    }
}
