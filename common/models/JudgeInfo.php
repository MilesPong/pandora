<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%judge_info}}".
 *
 * @property integer $match_id
 * @property string $referee
 * @property string $assistant
 * @property string $lineman1
 * @property string $lineman2
 *
 * @property MatchInfo $match
 */
class JudgeInfo extends \common\core\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%judge_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_id'], 'integer'],
            [['referee', 'assistant', 'lineman1', 'lineman2'], 'string', 'max' => 25],
            [['match_id'], 'unique'],
            [['match_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatchInfo::className(), 'targetAttribute' => ['match_id' => 'match_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'match_id' => Yii::t('app', 'Match ID'),
            'referee' => Yii::t('app', 'Referee'),
            'assistant' => Yii::t('app', 'Assistant'),
            'lineman1' => Yii::t('app', 'Lineman1'),
            'lineman2' => Yii::t('app', 'Lineman2'),
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
