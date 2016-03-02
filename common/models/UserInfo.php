<?php

namespace common\models;

use Yii;
use dektrium\user\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

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
 * @property string $avatar
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
     * @var mixed image the attribute for rendering the file input
     * widget for upload on the form
     */
    public $image;
    
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
            [['email', 'address', 'avatar'], 'string', 'max' => 255],
            [['qq'], 'string', 'max' => 15],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeamInfo::className(), 'targetAttribute' => ['team_id' => 'team_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['status', 'default', 'value' => 1],
            [['phone'], 'match' , 'pattern' =>'/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/',
                'message' => Yii::t('app', 'Your phone number is invalid.')],
            [['phone'], 'unique' , 'message' => Yii::t('app', 'Your phone number has been used.')],
            [['phone', 'truename', 'email', 'qq', 'address', 'avatar'], 'filter' , 'filter' => 'trim'],
            ['birthday', 'date', 'timestampAttribute' => 'birthday'],
            'emailPattern' => ['email', 'email'],
            'emailLength' => ['email', 'string', 'max' => 255],
            'emailUnique' => ['email', 'unique'],                
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png', 'maxSize'=>'1024 * 1024 * 2'], //Limit maxSize 2MB
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
            'avatar' => Yii::t('app', 'Avatar'),
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
     * {@inheritDoc}
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => [
                        'created_at',
                        'updated_at'
                    ],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [
                        'updated_at'
                    ]
                ]
            ]
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
    
    /**
     * @return Image Url
     */
    public function getImageUrl()
    {
        if ($this->avatar)
            return \Yii::$app->urlManagerFrontend->createUrl('uploads/avatar').DIRECTORY_SEPARATOR.$this->avatar;
        return null;
    }
    
    /**
     * fetch stored image file name with complete path
     * @return string
     */
    public function getImageFile()
    {
        return isset($this->avatar) && $this->avatar ? Yii::getAlias('@avatar') . DIRECTORY_SEPARATOR . $this->avatar : null;
    }
    
    /**
     * Process upload of image
     *
     * @return mixed the uploaded image instance
     */
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'image');
    
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
    
        // generate a unique file name
        $ext = end((explode(".", $image->name)));        
        $this->avatar = Yii::$app->security->generateRandomString().".{$ext}";
        
        // the uploaded image instance
        return $image;
    }
    
    /**
     * Process deletion of image
     *
     * @return boolean the status of deletion
     */
    public function deleteImage() {
        $file = $this->getImageFile();
    
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return true;
        }
    
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }
    
        // if deletion successful, reset your file attributes
        $this->avatar = null;
    
        return true;
    }
    
}
