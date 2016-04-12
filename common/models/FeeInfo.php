<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%fee_info}}".
 *
 * @property integer $fee_id
 * @property integer $match_id
 * @property integer $income
 * @property integer $expense
 * @property integer $remain
 * @property string $memo
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property MatchInfo $match
 */
class FeeInfo extends \common\core\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fee_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'memo'], 'required'],
            [['match_id', 'income', 'expense', 'status'], 'integer'],
            [['memo'], 'string'],
            [['match_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatchInfo::className(), 'targetAttribute' => ['match_id' => 'match_id']],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => $this->getStatusArray()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fee_id' => Yii::t('app', 'Fee ID'),
            'match_id' => Yii::t('app', 'Match ID'),
            'income' => Yii::t('app', 'Income'),
            'expense' => Yii::t('app', 'Expense'),
            'remain' => Yii::t('app', 'Remain'),
            'memo' => Yii::t('app', 'Memo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(MatchInfo::className(), ['match_id' => 'match_id']);
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
                        'updated_at',
                    ],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [
                        'updated_at',
                    ]
                ]                
            ],
        ];
    }
}
