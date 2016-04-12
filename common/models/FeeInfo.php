<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%fee_info}}".
 *
 * @property integer $fee_id
 * @property integer $match_id
 * @property integer $income
 * @property integer $expense
 * @property integer $remain
 * @property string $memo
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
            [['memo'], 'required'],
            [['match_id', 'income', 'expense', 'remain', 'status'], 'integer'],
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
}
